import java.util.ArrayList;
import java.util.Scanner;

public class App {

    private static final Repository<User> userRepository = new Repository<>();
    private static final Repository<Barang> barangRepository = new Repository<>();
    private static final Repository<Ruangan> ruanganRepository = new Repository<>();
    private static final Repository<Peminjaman> peminjamanRepository = new Repository<>();
    private static final Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        
        initializeData();

        boolean running = true;
        while (running) {
            System.out.println("=== SIMFAS ===");
            System.out.println("1. login");
            System.out.println("2. register");
            System.out.print(">> ");

            String choice = scanner.nextLine().trim();
            switch (choice) {
                case "1" -> loginUser();
                case "2" -> registerUser();
                default -> System.out.println("Pilihan tidak valid!\n");
            }
        }

        scanner.close();
    }

    private static void initializeData() {
        userRepository.add(new User("admin", "admin", "admin"));
        userRepository.add(new User("marcella", "1234", "user"));
        userRepository.add(new User("aaron", "1234", "user"));
        userRepository.add(new User("egbert", "1234", "user"));
        userRepository.add(new User("Yumel", "1234", "user"));
        userRepository.add(new User("Iwan", "1234", "user"));
        userRepository.add(new User("Grace", "1234", "user"));
        userRepository.add(new User("Hendrawan", "1234", "user"));

        barangRepository.add(new Barang("Meja", 50, "Yumel"));
        barangRepository.add(new Barang("Kursi", 100, "Yumel"));
        barangRepository.add(new Barang("Microphone", 5, "Iwan"));
        barangRepository.add(new Barang("Tenda", 10, "x"));

        ruanganRepository.add(new Ruangan("E-401", "Available", "Grace"));
        ruanganRepository.add(new Ruangan("Auditorium", "Available", "Hendrawan"));
        ruanganRepository.add(new Ruangan("B-503", "Available", "x"));
        ruanganRepository.add(new Ruangan("N-110", "Available", "Yumel"));

        peminjamanRepository.add(new Peminjaman("marcella", "Microphone", "2", "Acara XYZ", "Iwan", false, false, "barang"));
        peminjamanRepository.add(new Peminjaman("marcella", "Auditorium", "1", "Acara XYZ", "Hendrawan", false, false, "ruangan"));
        peminjamanRepository.add(new Peminjaman("aaron", "E-401", "1", "belajar bersama", "Grace", false, false, "ruangan"));
        peminjamanRepository.add(new Peminjaman("egbert", "Tenda", "2", "Acara ABC", "marcella", false, false, "barang"));
    }

    private static void registerUser() {
        System.out.print("Username: ");
        String username = scanner.nextLine().trim();

        if (isUsernameTaken(username)) {
            System.out.println("Username sudah terdaftar!\n");
            return;
        }

        System.out.print("Password: ");
        String password = scanner.nextLine().trim();
        userRepository.add(new User(username, password, "user"));
        System.out.println("Berhasil register sebagai user!\n");
    }

    private static void loginUser() {
        System.out.print("Username: ");
        String username = scanner.nextLine().trim();

        System.out.print("Password: ");
        String password = scanner.nextLine().trim();

        User user = findUser(username, password);
        if (user == null) {
            System.out.println("Username atau password salah!\n");
            return;
        }

        System.out.println("Berhasil login sebagai " + user.getRole() + "!\n");
        if (user.getRole().equals("admin")) {
            displayAdminMenu();
        } else {
            displayUserMenu(user);
        }
    }

    private static User findUser(String username, String password) {
        for (int i = 0; i < userRepository.size(); i++) {
            User user = userRepository.get(i);
            if (user.getUsername().equals(username) && user.getPassword().equals(password)) {
                return user;
            }
        }
        return null;
    }

    private static boolean isUsernameTaken(String username) {
        for (int i = 0; i < userRepository.size(); i++) {
            User user = userRepository.get(i);
            if (user.getUsername().equalsIgnoreCase(username)) {
                return true;
            }
        }
        return false;
    }

    private static void displayUserMenu(User user) {
        boolean running = true;
        while (running) {
            System.out.println("=== SIMFAS - USER ===");
            System.out.println("Selamat Datang, " + user.getUsername() + "!");
            displayUserBorrowingStatus(user);

            int incomingCount = countIncomingForUser(user);
            if (incomingCount > 0) {
                displayIncomingForUser(user);
            }

            System.out.println("=====================");
            System.out.println("1. Pinjam Barang");
            System.out.println("2. Pinjam Ruangan");
            System.out.println("3. Kembalikan Peminjaman");
            if (incomingCount > 0) {
                System.out.println("4. ACC Peminjaman");
            }
            System.out.println("0. Exit");
            System.out.print(">> ");

            String choice = scanner.nextLine().trim();
            switch (choice) {
                case "1" -> borrowBarang(user);
                case "2" -> borrowRuangan(user);
                case "3" -> returnPeminjaman(user);
                case "4" -> {
                    if (incomingCount > 0) {
                        accPeminjamanUntukUser(user);
                    } else {
                        System.out.println("Pilihan tidak valid!\n");
                    }
                }
                case "0" -> running = false;
                default -> System.out.println("Pilihan tidak valid!\n");
            }
        }
        System.out.println();
    }

    private static void displayUserBorrowingStatus(User user) {
        System.out.println("=====================");
        System.out.println("Status Peminjaman:");

        int count = 0;
        for (int i = 0; i < peminjamanRepository.size(); i++) {
            Peminjaman peminjaman = peminjamanRepository.get(i);
            if (!peminjaman.getNamaPeminjam().equals(user.getUsername())) {
                continue;
            }

            count++;
            System.out.println(count + ". " + formatBorrowingSummary(peminjaman));
            displayBorrowingStatusLines(peminjaman);
        }

        if (count == 0) {
            System.out.println("- tidak ada -");
        }
    }

    private static void displayIncomingForUser(User user) {
        System.out.println("=====================");
        System.out.println("Peminjaman Masuk:");

        int count = 0;
        for (int i = 0; i < peminjamanRepository.size(); i++) {
            Peminjaman peminjaman = peminjamanRepository.get(i);
            if (!peminjaman.getPenanggung().equals(user.getUsername())) {
                continue;
            }
            if (peminjaman.isPenanggungConfirmed()) {
                continue;
            }

            count++;
            System.out.println(count + ". " + formatBorrowingSummary(peminjaman));
        }

        if (count == 0) {
            System.out.println("- tidak ada -");
        }
    }

    private static int countIncomingForUser(User user) {
        int count = 0;
        for (int i = 0; i < peminjamanRepository.size(); i++) {
            Peminjaman peminjaman = peminjamanRepository.get(i);
            if (peminjaman.getPenanggung().equals(user.getUsername()) && !peminjaman.isPenanggungConfirmed()) {
                count++;
            }
        }
        return count;
    }

    private static void borrowBarang(User user) {
        System.out.println("== Pinjam Barang ==");
        for (int i = 0; i < barangRepository.size(); i++) {
            Barang barang = barangRepository.get(i);
            System.out.println((i + 1) + ". " + barang.toString());
        }
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int index = toPositiveInt(choice) - 1;
        if (index < 0 || index >= barangRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Barang selected = barangRepository.get(index);
        System.out.print("Jumlah: ");
        String jumlahStr = scanner.nextLine().trim();
        if (!isPositiveInteger(jumlahStr)) {
            System.out.println("Jumlah tidak valid!\n");
            return;
        }

        int jumlah = toPositiveInt(jumlahStr);
        if (jumlah <= 0 || jumlah > selected.getStock()) {
            System.out.println("Jumlah melebihi limit!\n");
            return;
        }

        System.out.print("Alasan: ");
        String alasan = scanner.nextLine().trim();

        selected.setStock(selected.getStock() - jumlah);
        String penanggung = selected.getHandler();
        peminjamanRepository.add(new Peminjaman(
            user.getUsername(),
            selected.getName(),
            Integer.toString(jumlah),
            alasan,
            penanggung,
            false,
            false,
            "barang"
        ));

        if (penanggung.equals("x")) {
            System.out.println("Peminjaman Berhasil! Menunggu konfirmasi dari Admin.\n");
        } else {
            System.out.println("Peminjaman Berhasil! Menunggu konfirmasi dari " + penanggung + " dan Admin.\n");
        }
    }

    private static void borrowRuangan(User user) {
        System.out.println("== Pinjam Ruangan ==");
        for (int i = 0; i < ruanganRepository.size(); i++) {
            Ruangan ruangan = ruanganRepository.get(i);
            System.out.println((i + 1) + ". " + ruangan.toString());
        }

        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int selectedNumber = toPositiveInt(choice);
        if (selectedNumber < 1 || selectedNumber > ruanganRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Ruangan selected = ruanganRepository.get(selectedNumber - 1);
        if (selected.getStatus().equalsIgnoreCase("Dipinjam")) {
            System.out.println("Ruangan sedang dipinjam dan tidak bisa dipilih!\n");
            return;
        }

        System.out.print("Alasan: ");
        String alasan = scanner.nextLine().trim();

        selected.setStatus("Dipinjam");
        String penanggung = selected.getHandler();
        peminjamanRepository.add(new Peminjaman(
            user.getUsername(),
            selected.getName(),
            "1",
            alasan,
            penanggung,
            false,
            false,
            "ruangan"
        ));

        if (penanggung.equals("x")) {
            System.out.println("Peminjaman Berhasil! Menunggu konfirmasi dari Admin.\n");
        } else {
            System.out.println("Peminjaman Berhasil! Menunggu konfirmasi dari " + penanggung + " dan Admin.\n");
        }
    }

    private static void returnPeminjaman(User user) {
        System.out.println("== Pengembalian ==");
        int[] returnableIndices = new int[peminjamanRepository.size()];
        int count = 0;

        for (int i = 0; i < peminjamanRepository.size(); i++) {
            Peminjaman peminjaman = peminjamanRepository.get(i);
            if (peminjaman.getNamaPeminjam().equals(user.getUsername()) && peminjaman.isReady()) {
                count++;
                returnableIndices[count - 1] = i;
                System.out.println(count + ". " + returnLabel(peminjaman));
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

        int selectedNumber = toPositiveInt(choice);
        if (selectedNumber == 0) {
            return;
        }
        if (selectedNumber < 1 || selectedNumber > count) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int repoIndex = returnableIndices[selectedNumber - 1];
        Peminjaman selected = peminjamanRepository.get(repoIndex);

        if (selected.getType().equals("barang")) {
            for (int i = 0; i < barangRepository.size(); i++) {
                Barang barang = barangRepository.get(i);
                if (barang.getName().equals(selected.getNamaBarangDipinjam())) {
                    int jumlah = isPositiveInteger(selected.getJumlah()) ? toPositiveInt(selected.getJumlah()) : 0;
                    barang.setStock(barang.getStock() + jumlah);
                    break;
                }
            }
        } else if (selected.getType().equals("ruangan")) {
            for (int i = 0; i < ruanganRepository.size(); i++) {
                Ruangan ruangan = ruanganRepository.get(i);
                if (ruangan.getName().equals(selected.getNamaBarangDipinjam())) {
                    ruangan.setStatus("Available");
                    break;
                }
            }
        }

        peminjamanRepository.remove(repoIndex);
        System.out.println("Barang berhasil dikembalikan!\n");
    }

    private static void accPeminjamanUntukUser(User user) {
        handleAccPeminjaman(user.getUsername(), false);
    }

    private static void displayAdminMenu() {
        boolean running = true;
        while (running) {
            System.out.println("=== SIMFAS - ADMIN ===");
            System.out.println("Selamat Datang, admin!");
            displayAllBorrowings();
            System.out.println("======================");
            System.out.println("1. Kelola Barang");
            System.out.println("2. Kelola Ruangan");
            System.out.println("3. ACC Peminjaman");
            System.out.println("0. Exit");
            System.out.print(">> ");

            String choice = scanner.nextLine().trim();
            switch (choice) {
                case "1" -> manageBarang();
                case "2" -> manageRuangan();
                case "3" -> handleAccPeminjaman("admin", true);
                case "0" -> running = false;
                default -> System.out.println("Pilihan tidak valid!\n");
            }
        }
        System.out.println();
    }

    private static void displayAllBorrowings() {
        System.out.println("======================");
        System.out.println("Peminjaman Masuk:");
        if (peminjamanRepository.size() == 0) {
            System.out.println("- tidak ada -");
            return;
        }

        for (int i = 0; i < peminjamanRepository.size(); i++) {
            Peminjaman peminjaman = peminjamanRepository.get(i);
            System.out.println((i + 1) + ". " + formatBorrowingSummary(peminjaman));
        }
    }

    private static void manageBarang() {
        boolean running = true;
        while (running) {
            System.out.println("== Kelola Barang ==");
            displayBarangList();
            System.out.println("==================");
            System.out.println("1. Create Barang");
            System.out.println("2. Edit Barang");
            System.out.println("3. Delete Barang");
            System.out.println("4. Assign Penanggung Jawab");
            System.out.println("0. Exit");
            System.out.print(">> ");

            String choice = scanner.nextLine().trim();
            switch (choice) {
                case "1" -> createBarang();
                case "2" -> editBarang();
                case "3" -> deleteBarang();
                case "4" -> assignBarangPenanggungJawab();
                case "0" -> running = false;
                default -> System.out.println("Pilihan tidak valid!\n");
            }
        }
    }

    private static void manageRuangan() {
        boolean running = true;
        while (running) {
            System.out.println("== Kelola Ruangan ==");
            displayRuanganList();
            System.out.println("===================");
            System.out.println("1. Create Ruangan");
            System.out.println("2. Edit Ruangan");
            System.out.println("3. Delete Ruangan");
            System.out.println("4. Assign Penanggung Jawab");
            System.out.println("0. Exit");
            System.out.print(">> ");

            String choice = scanner.nextLine().trim();
            switch (choice) {
                case "1" -> createRuangan();
                case "2" -> editRuangan();
                case "3" -> deleteRuangan();
                case "4" -> assignRuanganPenanggungJawab();
                case "0" -> running = false;
                default -> System.out.println("Pilihan tidak valid!\n");
            }
        }
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

        barangRepository.add(new Barang(namaBarang, stock, "x"));
        System.out.println("Barang berhasil dibuat!\n");
    }

    private static void editBarang() {
        System.out.println("Pilih barang mana yang mau diubah:");
        displayBarangList();
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int index = toPositiveInt(choice) - 1;
        if (index < 0 || index >= barangRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Barang selected = barangRepository.get(index);
        System.out.print("Nama barang: ");
        String namaBaru = scanner.nextLine().trim();
        System.out.print("Stock: ");
        String stockStr = scanner.nextLine().trim();
        if (!isPositiveInteger(stockStr)) {
            System.out.println("Stock tidak valid!\n");
            return;
        }

        int stockBaru = toPositiveInt(stockStr);
        if (stockBaru <= 0) {
            System.out.println("Stock tidak valid!\n");
            return;
        }

        if (!selected.getName().equalsIgnoreCase(namaBaru) && isBarangExists(namaBaru)) {
            System.out.println("Barang ini sudah ada!\n");
            return;
        }

        selected.setName(namaBaru);
        selected.setStock(stockBaru);
        System.out.println("Barang berhasil diedit!\n");
    }

    private static void deleteBarang() {
        System.out.println("Pilih barang mana yang mau dihapus:");
        displayBarangList();
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int index = toPositiveInt(choice) - 1;
        if (index < 0 || index >= barangRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        barangRepository.remove(index);
        System.out.println("Barang berhasil dihapus!\n");
    }

    private static void assignBarangPenanggungJawab() {
        int selectedIndex = selectBarangWithNoHandler("Pilih barang mana yang mau diassign:");
        if (selectedIndex == -1) {
            return;
        }

        int userIndex = selectUserForAssignment("Pilih user untuk menjadi penanggung jawab:");
        if (userIndex == -1) {
            return;
        }

        Barang selectedBarang = barangRepository.get(selectedIndex);
        User selectedUser = getNonAdminUsers().get(userIndex);
        selectedBarang.setHandler(selectedUser.getUsername());
        System.out.println("Berhasil assign " + selectedUser.getUsername() + " sebagai penanggung jawab " + selectedBarang.getName() + "!\n");
    }

    private static void createRuangan() {
        System.out.print("Nama ruangan: ");
        String namaRuangan = scanner.nextLine().trim();

        if (isRuanganExists(namaRuangan)) {
            System.out.println("Ruangan ini sudah ada!\n");
            return;
        }

        ruanganRepository.add(new Ruangan(namaRuangan, "Available", "x"));
        System.out.println("Ruangan berhasil dibuat!\n");
    }

    private static void editRuangan() {
        System.out.println("Pilih ruangan mana yang mau diubah:");
        displayRuanganList();
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int index = toPositiveInt(choice) - 1;
        if (index < 0 || index >= ruanganRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Ruangan selected = ruanganRepository.get(index);
        System.out.print("Nama ruangan: ");
        String namaBaru = scanner.nextLine().trim();
        System.out.print("Status (Available/Dipinjam): ");
        String statusBaru = scanner.nextLine().trim();

        if (!selected.getName().equalsIgnoreCase(namaBaru) && isRuanganExists(namaBaru)) {
            System.out.println("Ruangan ini sudah ada!\n");
            return;
        }

        if (!statusBaru.equalsIgnoreCase("Available") && !statusBaru.equalsIgnoreCase("Dipinjam")) {
            System.out.println("Status tidak valid!\n");
            return;
        }

        selected.setName(namaBaru);
        selected.setStatus(statusBaru);
        System.out.println("Ruangan berhasil diedit!\n");
    }

    private static void deleteRuangan() {
        System.out.println("Pilih ruangan mana yang mau dihapus:");
        displayRuanganList();
        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int index = toPositiveInt(choice) - 1;
        if (index < 0 || index >= ruanganRepository.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        ruanganRepository.remove(index);
        System.out.println("Ruangan berhasil dihapus!\n");
    }

    private static void assignRuanganPenanggungJawab() {
        int selectedIndex = selectRuanganWithNoHandler("Pilih ruangan mana yang mau diassign:");
        if (selectedIndex == -1) {
            return;
        }

        int userIndex = selectUserForAssignment("Pilih user untuk menjadi penanggung jawab:");
        if (userIndex == -1) {
            return;
        }

        Ruangan selectedRuangan = ruanganRepository.get(selectedIndex);
        User selectedUser = getNonAdminUsers().get(userIndex);
        selectedRuangan.setHandler(selectedUser.getUsername());
        System.out.println("Berhasil assign " + selectedUser.getUsername() + " sebagai penanggung jawab " + selectedRuangan.getName() + "!\n");
    }

    private static void handleAccPeminjaman(String actorUsername, boolean adminMode) {
        System.out.println("Pilih mau ACC peminjaman mana:");

        int[] selectableIndices = new int[peminjamanRepository.size()];
        int count = 0;

        for (int i = 0; i < peminjamanRepository.size(); i++) {
            Peminjaman peminjaman = peminjamanRepository.get(i);
            if (adminMode) {
                count++;
                selectableIndices[count - 1] = i;
                System.out.println(count + ". " + formatBorrowingSummary(peminjaman));
            } else {
                if (peminjaman.getPenanggung().equals(actorUsername) && !peminjaman.isPenanggungConfirmed()) {
                    count++;
                    selectableIndices[count - 1] = i;
                    System.out.println(count + ". " + formatBorrowingSummary(peminjaman));
                }
            }
        }

        if (count == 0) {
            System.out.println("- tidak ada -\n");
            return;
        }

        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        int selectedNumber = toPositiveInt(choice);
        if (selectedNumber < 1 || selectedNumber > count) {
            System.out.println("Pilihan tidak valid!\n");
            return;
        }

        Peminjaman peminjaman = peminjamanRepository.get(selectableIndices[selectedNumber - 1]);
        if (adminMode)
            peminjaman.setAdminConfirmed(true);
        else
            peminjaman.setPenanggungConfirmed(true);

        System.out.println("Peminjaman berhasil konfirmasi!\n");
    }

    private static void displayBarangList() {
        for (int i = 0; i < barangRepository.size(); i++) {
            Barang barang = barangRepository.get(i);
            System.out.println((i + 1) + ". " + barang.toString());
        }
    }

    private static void displayRuanganList() {
        for (int i = 0; i < ruanganRepository.size(); i++) {
            Ruangan ruangan = ruanganRepository.get(i);
            System.out.println((i + 1) + ". " + ruangan.toString());
        }
    }

    private static int selectBarangWithNoHandler(String title) {
        System.out.println(title);
        int[] selectableIndices = new int[barangRepository.size()];
        int count = 0;
        for (int i = 0; i < barangRepository.size(); i++) {
            Barang barang = barangRepository.get(i);
            if (barang.getHandler().equals("x")) {
                count++;
                selectableIndices[count - 1] = i;
                System.out.println(count + ". " + barang.toString());
            }
        }

        if (count == 0) {
            System.out.println("Tidak ada barang yang belum memiliki penanggung jawab.\n");
            return -1;
        }

        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return -1;
        }

        int selectedNumber = toPositiveInt(choice);
        if (selectedNumber < 1 || selectedNumber > count) {
            System.out.println("Pilihan tidak valid!\n");
            return -1;
        }

        return selectableIndices[selectedNumber - 1];
    }

    private static int selectRuanganWithNoHandler(String title) {
        System.out.println(title);
        int[] selectableIndices = new int[ruanganRepository.size()];
        int count = 0;
        for (int i = 0; i < ruanganRepository.size(); i++) {
            Ruangan ruangan = ruanganRepository.get(i);
            if (ruangan.getHandler().equals("x")) {
                count++;
                selectableIndices[count - 1] = i;
                System.out.println(count + ". " + ruangan.toString());
            }
        }

        if (count == 0) {
            System.out.println("Tidak ada ruangan yang belum memiliki penanggung jawab.\n");
            return -1;
        }

        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return -1;
        }

        int selectedNumber = toPositiveInt(choice);
        if (selectedNumber < 1 || selectedNumber > count) {
            System.out.println("Pilihan tidak valid!\n");
            return -1;
        }

        return selectableIndices[selectedNumber - 1];
    }

    private static int selectUserForAssignment(String title) {
        System.out.println(title);
        ArrayList<User> assignableUsers = getNonAdminUsers();
        for (int i = 0; i < assignableUsers.size(); i++) {
            System.out.println((i + 1) + ". " + assignableUsers.get(i).getUsername());
        }

        System.out.print(">> ");
        String choice = scanner.nextLine().trim();
        if (!isPositiveInteger(choice)) {
            System.out.println("Pilihan tidak valid!\n");
            return -1;
        }

        int selectedNumber = toPositiveInt(choice);
        if (selectedNumber < 1 || selectedNumber > assignableUsers.size()) {
            System.out.println("Pilihan tidak valid!\n");
            return -1;
        }

        return selectedNumber - 1;
    }

    private static ArrayList<User> getNonAdminUsers() {
        ArrayList<User> result = new ArrayList<>();
        for (int i = 0; i < userRepository.size(); i++) {
            User user = userRepository.get(i);
            if (!user.getRole().equals("admin")) {
                result.add(user);
            }
        }
        return result;
    }

    private static void displayBorrowingStatusLines(Peminjaman peminjaman) {
        if (peminjaman.isReady()) {
            System.out.println("- (Siap Pakai)");
            return;
        }

        if (!peminjaman.getPenanggung().equals("x")) {
            if (peminjaman.isPenanggungConfirmed()) {
                System.out.println("- Sudah dikonfirmasi " + peminjaman.getPenanggung());
            } else {
                System.out.println("- Menunggu konfirmasi " + peminjaman.getPenanggung());
            }
        }

        if (peminjaman.isAdminConfirmed())
            System.out.println("- Sudah dikonfirmasi Admin");
        else
            System.out.println("- Menunggu konfirmasi Admin");
    }

    private static String formatBorrowingSummary(Peminjaman peminjaman) {
        if (peminjaman.getType().equals("barang")) 
            return peminjaman.getNamaPeminjam() + " - " + peminjaman.getNamaBarangDipinjam() + " (" + peminjaman.getJumlah() + "x) - " + peminjaman.getAlasan();
        
        return peminjaman.getNamaPeminjam() + " - " + peminjaman.getNamaBarangDipinjam() + " - " + peminjaman.getAlasan();
    }

    private static String returnLabel(Peminjaman peminjaman) {
        if (peminjaman.getType().equals("barang")) 
            return peminjaman.getNamaBarangDipinjam() + " (" + peminjaman.getJumlah() + "x)";
        
        return peminjaman.getNamaBarangDipinjam();
    }

    private static boolean isBarangExists(String namaBarang) {
        for (int i = 0; i < barangRepository.size(); i++) {
            Barang barang = barangRepository.get(i);
            if (barang.getName().equalsIgnoreCase(namaBarang)) 
                return true;

        }
        return false;
    }

    private static boolean isRuanganExists(String namaRuangan) {
        for (int i = 0; i < ruanganRepository.size(); i++) {
            Ruangan ruangan = ruanganRepository.get(i);
            if (ruangan.getName().equalsIgnoreCase(namaRuangan)) 
                return true;            
        }
        return false;
    }

    private static boolean isPositiveInteger(String value) {
        if (value == null || value.isEmpty())
            return false;

        for (int i = 0; i < value.length(); i++) {
            if (!Character.isDigit(value.charAt(i)))
                return false;
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

}
