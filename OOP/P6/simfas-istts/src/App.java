import java.util.Scanner;

public class App {

    private final static Repository<User> userRepository = new Repository<>();
    private final static Repository<Barang> itemRepository = new Repository<>();
    private final static Repository<Ruangan> roomRepository = new Repository<>();
    private final static Repository<Peminjaman> borrowingRepository = new Repository<>();
    private final static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) throws Exception {

        userRepository.add(new User("admin", "admin", "admin"));
        
        itemRepository.add(new Barang("Meja", 50, "Yumel"));
        itemRepository.add(new Barang("Kursi", 100, "Yumel"));
        itemRepository.add(new Barang("Microphone", 5, "Iwan"));
        itemRepository.add(new Barang("Tenda", 10, "x"));

        roomRepository.add(new Ruangan("E-401", "Available", "Grace"));
        roomRepository.add(new Ruangan("Auditorium", "Available", "Hendrawan"));
        roomRepository.add(new Ruangan("B-503", "Available", "x"));
        roomRepository.add(new Ruangan("N-110", "Dipinjam", "Yumel"));

        boolean running = true;

        while (running) {

            System.out.println("=== SIMFAS ===");
            System.out.println("1. login");
            System.out.println("2. register");

            System.out.print(">> ");
            String choice = scanner.nextLine().trim();

            switch (choice) {
                case "1" ->
                    loginUser();
                case "2" ->
                    registerUser();
                default ->
                    System.out.println("Pilihan tidak valid!\n");
            }
        }

        scanner.close();
    }

    private static void registerUser() {
        System.out.println("\n=== REGISTER ===");
        System.out.print("Username: ");
        String username = scanner.nextLine().trim();

        if (isUsernameTaken(username)) {
            System.out.println("Username sudah terdaftar!\n");
            return;
        }

        System.out.print("Password: ");
        String password = scanner.nextLine().trim();

        User newUser = new User(username, password, "user");
        userRepository.add(newUser);

        System.out.println("Berhasil register sebagai user!\n");
    }

    private static void loginUser() {
        System.out.println("\n=== LOGIN ===");
        System.out.print("Username: ");
        String username = scanner.nextLine().trim();

        System.out.print("Password: ");
        String password = scanner.nextLine().trim();

        User user = findUser(username, password);

        if (user == null) {
            System.out.println("Username atau password salah!\n");
            return;
        }

        if (user.getRole().equals("admin")) {
            System.out.println("Berhasil login sebagai admin!\n");
            displayAdminMenu();
        } else {
            System.out.println("Berhasil login sebagai user!\n");
            displayUserMenu(user);
        }
    }

    private static User findUser(String username, String password) {
        for (int i = 0; i < userRepository.size(); i++) {
            User user = userRepository.get(i);
            if (user != null && user.getUsername().equals(username) && user.getPassword().equals(password)) {
                return user;
            }
        }
        return null;
    }

    private static boolean isUsernameTaken(String username) {
        for (int i = 0; i < userRepository.size(); i++) {
            User user = userRepository.get(i);
            if (user != null && user.getUsername().equals(username)) {
                return true;
            }
        }
        return false;
    }

    private static void displayUserMenu(User user) {
        boolean inMenu = true;
        while (inMenu) {
            System.out.println("=== SIMFAS - USER ===");
            System.out.println("Selamat Datang, " + user.getUsername() + "!");
            System.out.println("=====================");
            System.out.println("Status Peminjaman:");
            int count = 0;
            for (int i = 0; i < borrowingRepository.size(); i++) {
                Peminjaman p = borrowingRepository.get(i);
                if (p.getNamaPeminjam().equals(user.getUsername())) {
                    count++;
                    System.out.println(count + ". " + p.getNamaBarangDipinjam() + " (" + p.getJumlah() + "x) – " + p.getAlasan());
                    if (p.isReady()) {
                        System.out.println("- (Siap Pakai)");
                    } else {
                        if (p.isPenanggungConfirmed()) {
                            System.out.println("- Sudah dikonfirmasi " + p.getPenanggung());
                        } else {
                            if (!p.getPenanggung().equals("x")) {
                                System.out.println("- Menunggu Konfirmasi " + p.getPenanggung());
                            }
                        }
                        if (!p.isAdminConfirmed()) {
                            System.out.println("- Menunggu Konfirmasi Admin");
                        }
                    }
                }
            }
            if (count == 0) {
                System.out.println("- tidak ada -");
            }
            System.out.println("=====================");
            System.out.println("1. Pinjam Barang");
            System.out.println("2. Pinjam Ruangan");
            System.out.println("3. Kembalikan Peminjaman");
            System.out.println("0. Exit");
            System.out.print(">> ");
            String sel = scanner.nextLine().trim();

            switch (sel) {
                case "1" -> handleBorrow(user);
                case "2" -> handleBorrowRoom(user);
                case "3" -> handleReturn(user);
                case "0" -> inMenu = false;
                default -> System.out.println("Pilihan tidak valid!\n");
            }
        }
        System.out.println();
    }

    private static void handleBorrow(User user) {
        System.out.println("Pilih barang mana yang mau dipinjam:");
        for (int i = 0; i < itemRepository.size(); i++) {
            Barang it = itemRepository.get(i);
            System.out.println((i + 1) + ". " + it.toString());
        }
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int idx = toPositiveInt(choice) - 1;

        if (idx < 0 || idx >= itemRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Barang selected = itemRepository.get(idx);
        System.out.print("Jumlah: ");
        String qtyStr = scanner.nextLine().trim();
        if (!isPositiveInteger(qtyStr)) {
            System.out.println("Jumlah tidak valid!\n");
            return;
        }

        int qty = toPositiveInt(qtyStr);

        if (qty > selected.getStock()) {
            System.out.println("Jumlah melebihi limit!\n");
            return;
        }

        System.out.print("Alasan: ");
        String reason = scanner.nextLine().trim();

        String penanggung = selected.getHandler();
        boolean penanggungConfirmed = penanggung.equals("x");
        selected.setStock(selected.getStock() - qty);
        borrowingRepository.add(new Peminjaman(
            user.getUsername(),
            selected.getName(),
            Integer.toString(qty),
            reason,
            penanggung,
            penanggungConfirmed,
            false,
            "barang"
        ));

        if (penanggung.equals("x")) {
            System.out.println("Peminjaman Berhasil! Menunggu konfirmasi dari Admin.\n");
        } else {
            System.out.println("Peminjaman Berhasil! Menunggu konfirmasi dari " + penanggung + " dan Admin.\n");
        }
    }

    private static void handleBorrowRoom(User user) {
        System.out.println("== Pinjam Ruangan ==");
        for (int i = 0; i < roomRepository.size(); i++) {
            Ruangan r = roomRepository.get(i);
            System.out.println((i + 1) + ". " + r.toString());
        }
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }
        int idx = toPositiveInt(choice) - 1;
        if (idx < 0 || idx >= roomRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Ruangan selected = roomRepository.get(idx);
        if (selected.getStatus().equalsIgnoreCase("Dipinjam")) {
            System.out.println("Ruangan sedang dipinjam dan tidak bisa dipilih!\n");
            return;
        }

        System.out.print("Alasan: ");
        String reason = scanner.nextLine().trim();

        String penanggung = selected.getHandler();
        boolean penanggungConfirmed = penanggung.equals("x");

        borrowingRepository.add(new Peminjaman(
            user.getUsername(),
            selected.getName(),
            "1",
            reason,
            penanggung,
            penanggungConfirmed,
            false,
            "ruangan"
        ));

        if (penanggung.equals("x")) {
            System.out.println("Peminjaman Berhasil! Menunggu konfirmasi dari Admin.\n");
        } else {
            System.out.println("Peminjaman Berhasil! Menunggu konfirmasi dari " + penanggung + " dan Admin.\n");
        }
    }

    private static void handleReturn(User user) {
        System.out.println("== Pengembalian ==");
        int count = 0;
        int[] indices = new int[borrowingRepository.size()];
        for (int i = 0; i < borrowingRepository.size(); i++) {
            Peminjaman p = borrowingRepository.get(i);
            if (p.getNamaPeminjam().equals(user.getUsername()) && p.isReady()) {
                count++;
                indices[count-1] = i;
                System.out.println(count + ". " + p.getNamaBarangDipinjam() + " (" + p.getJumlah() + "x)");
            }
        }
        if (count == 0) {
            System.out.println("Tidak ada peminjaman yang bisa dikembalikan.\n");
            return;
        }
        System.out.println("0. Exit");
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }
        int sel = toPositiveInt(choice);
        if (sel == 0) return;
        if (sel < 1 || sel > count) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }
        int repoIndex = indices[sel-1];
        Peminjaman p = borrowingRepository.get(repoIndex);
        if (p.getType().equals("barang")) {
            for (int i = 0; i < itemRepository.size(); i++) {
                Barang b = itemRepository.get(i);
                if (b.getName().equals(p.getNamaBarangDipinjam())) {
                    int add = 0;
                    String jumlahStr = p.getJumlah();
                    if (isPositiveInteger(jumlahStr)) {
                        add = toPositiveInt(jumlahStr);
                    }
                    b.setStock(b.getStock() + add);
                    break;
                }
            }
        } else if (p.getType().equals("ruangan")) {
            for (int i = 0; i < roomRepository.size(); i++) {
                Ruangan r = roomRepository.get(i);
                if (r.getName().equals(p.getNamaBarangDipinjam())) {
                    r.setStatus("Available");
                    break;
                }
            }
        }
        borrowingRepository.remove(repoIndex);
        System.out.println("Barang berhasil dikembalikan!\n");
    }

    private static boolean isPositiveInteger(String value) {
        if (value == null || value.isEmpty()) {
            return false;
        }

        for (int i = 0; i < value.length(); i++) {
            if (!Character.isDigit(value.charAt(i))) {
                return false;
            }
        }

        return true;
    }

    private static int toPositiveInt(String value) {
        int result = 0;
        for (int i = 0; i < value.length(); i++) {
            result = result * 10 + (value.charAt(i) - '0');
        }
        return result;
    }

    private static void displayAdminMenu() {
        boolean inMenu = true;
        while (inMenu) {
            System.out.println("=== SIMFAS - ADMIN ===");
            System.out.println("Selamat datang, admin!");
            System.out.println("Barang(s):");
            for (int i = 0; i < itemRepository.size(); i++) {
                Barang it = itemRepository.get(i);
                System.out.println((i + 1) + ". " + it.toString());
            }
            System.out.println("======================");
            System.out.println("1. Create Barang");
            System.out.println("2. Edit Barang");
            System.out.println("3. Delete Barang");
            System.out.println("4. Riwayat Peminjaman");
            System.out.println("5. Konfirmasi Peminjaman");
            System.out.println("0. Exit");
            System.out.print(">> ");

            String choice = scanner.nextLine().trim();
            switch (choice) {
                case "1" -> createBarang();
                case "2" -> editBarang();
                case "3" -> deleteBarang();
                case "4" -> showRiwayatPeminjaman();
                case "5" -> manageConfirmations();
                case "0" -> inMenu = false;
                default -> System.out.println("Pilihan tidak valid!\n");
            }
        }
        System.out.println();
    }

    private static void createBarang() {
        System.out.print("Nama barang: ");
        String namaBarang = scanner.nextLine().trim();

        if (isBarangExists(namaBarang)) {
            System.out.println("Barang ini sudah ada!\n");
            return;
        }

        System.out.print("Stock: ");
        String stockStr = scanner.nextLine().trim();
        if (!isPositiveInteger(stockStr)) {
            System.out.println("Stock tidak valid!\n");
            return;
        }

        int stock = toPositiveInt(stockStr);
        if (stock <= 0) {
            System.out.println("Stock tidak valid!\n");
            return;
        }

        System.out.print("Penanggung jawab (kosong = x): ");
        String handler = scanner.nextLine().trim();
        if (handler.isEmpty()) handler = "x";
        itemRepository.add(new Barang(namaBarang, stock, handler));
        System.out.println("Barang berhasil dibuat!\n");
    }

    private static void editBarang() {
        System.out.println("Pilih barang yang ingin diedit:");
        for (int i = 0; i < itemRepository.size(); i++) {
            Barang it = itemRepository.get(i);
            System.out.println((i + 1) + ". " + it.toString());
        }
        System.out.print(">> ");
        String idxStr = scanner.nextLine().trim();

        if (!isPositiveInteger(idxStr)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int idx = toPositiveInt(idxStr) - 1;
        if (idx < 0 || idx >= itemRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Barang selected = itemRepository.get(idx);
        System.out.print("Nama barang baru: ");
        String newName = scanner.nextLine().trim();

        if (!selected.getName().equalsIgnoreCase(newName) && isBarangExists(newName)) {
            System.out.println("Barang ini sudah ada!\n");
            return;
        }

        System.out.print("Stock baru: ");
        String stockStr = scanner.nextLine().trim();
        if (!isPositiveInteger(stockStr)) {
            System.out.println("Stock tidak valid!\n");
            return;
        }

        int newStock = toPositiveInt(stockStr);
        if (newStock <= 0) {
            System.out.println("Stock tidak valid!\n");
            return;
        }

        System.out.print("Penanggung baru (kosong = x): ");
        String newHandler = scanner.nextLine().trim();
        if (newHandler.isEmpty()) newHandler = "x";
        selected.setName(newName);
        selected.setStock(newStock);
        selected.setHandler(newHandler);
        System.out.println("Barang berhasil diedit!\n");
    }

    private static void deleteBarang() {
        System.out.println("Pilih barang yang ingin dihapus:");
        for (int i = 0; i < itemRepository.size(); i++) {
            Barang it = itemRepository.get(i);
            System.out.println((i + 1) + ". " + it.toString());
        }
        System.out.print(">> ");
        String idxStr = scanner.nextLine().trim();

        if (!isPositiveInteger(idxStr)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int idx = toPositiveInt(idxStr) - 1;
        if (idx < 0 || idx >= itemRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        itemRepository.remove(idx);
        System.out.println("Barang berhasil dihapus!\n");
    }

    private static void manageConfirmations() {
        System.out.println("== Konfirmasi Peminjaman ==");
        if (borrowingRepository.size() == 0) {
            System.out.println("Belum ada peminjaman.\n");
            return;
        }

        for (int i = 0; i < borrowingRepository.size(); i++) {
            Peminjaman p = borrowingRepository.get(i);
            System.out.println((i + 1) + ". " + p.getNamaPeminjam() + " - " + p.getNamaBarangDipinjam() + " (" + p.getJumlah() + "x)");
            System.out.println("   Penanggung: " + p.getPenanggung() + " | PenanggungConfirmed: " + p.isPenanggungConfirmed() + " | AdminConfirmed: " + p.isAdminConfirmed());
        }
        System.out.println("0. Exit");
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }
        int idx = toPositiveInt(choice);
        if (idx == 0) return;
        idx = idx - 1;
        if (idx < 0 || idx >= borrowingRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Peminjaman p = borrowingRepository.get(idx);
        System.out.println("1. Konfirmasi Penanggung");
        System.out.println("2. Konfirmasi Admin");
        System.out.println("3. Konfirmasi Kedua-duanya");
        System.out.println("0. Kembali");
        System.out.print(">> ");
        String act = scanner.nextLine().trim();
        switch (act) {
            case "1" -> p.setPenanggungConfirmed(true);
            case "2" -> p.setAdminConfirmed(true);
            case "3" -> { p.setPenanggungConfirmed(true); p.setAdminConfirmed(true); }
            case "0" -> { return; }
            default -> { System.out.println("Pilihan tidak valid!\n"); return; }
        }

        if (p.isReady() && p.getType().equals("ruangan")) {
            for (int i = 0; i < roomRepository.size(); i++) {
                Ruangan r = roomRepository.get(i);
                if (r.getName().equals(p.getNamaBarangDipinjam())) {
                    r.setStatus("Dipinjam");
                    break;
                }
            }
        }

        System.out.println("Konfirmasi berhasil dilakukan.\n");
    }

    private static void showRiwayatPeminjaman() {
        System.out.println("== Riwayat Peminjaman ==");
        if (borrowingRepository.size() == 0) {
            System.out.println("Belum ada riwayat peminjaman.\n");
            return;
        }

        for (int i = 0; i < borrowingRepository.size(); i++) {
            Peminjaman p = borrowingRepository.get(i);
            System.out.println((i + 1) + ". " + p.getNamaPeminjam() + " - " + p.getNamaBarangDipinjam() + " " + p.getJumlah() + "x");
            System.out.println("- Alasan: " + p.getAlasan());
        }
        System.out.println();
    }

    private static boolean isBarangExists(String namaBarang) {
        for (int i = 0; i < itemRepository.size(); i++) {
            Barang barang = itemRepository.get(i);
            if (barang != null && barang.getName().equalsIgnoreCase(namaBarang)) {
                return true;
            }
        }
        return false;
    }

}
