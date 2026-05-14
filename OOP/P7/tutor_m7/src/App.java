import java.util.Scanner;

public class App {
    public static void main(String[] args) throws Exception {
        Scanner input = new Scanner(System.in);

        Pokemon[] pilihan = { new Pikachu(), new Charizard(), new Blastoise() };

        System.out.println("=== PILIH POKEMON ===");
        for (int i = 0; i < pilihan.length; i++) {
            System.out.print((i + 1) + ". ");
            pilihan[i].info();
        }

        System.out.print("Pilih Pokemon kamu (1-3): ");
        int pilih = input.nextInt();

        while (pilih < 1 || pilih > 3) {
            System.out.print("Pilihan tidak valid. Pilih lagi (1-3): ");
            pilih = input.nextInt();
        }

        Pokemon pemain = pilihan[pilih - 1];
        Pokemon lawan;

        do {
            lawan = pilihan[(int) (Math.random() * pilihan.length)];
        } while (lawan == pemain);

        System.out.println("\nPokemon kamu: " + pemain.nama);
        System.out.println("Lawan kamu: " + lawan.nama);
        System.out.println("\n=== PERTARUNGAN DIMULAI ===");

        while (!pemain.kalah() && !lawan.kalah()) {
            System.out.println("\nGiliran kamu:");
            pemain.serangKe(lawan);
            System.out.println("Sisa HP lawan: " + lawan.hp);

            if (lawan.kalah()) {
                break;
            }

            System.out.println("\nGiliran lawan:");
            lawan.serangKe(pemain);
            System.out.println("Sisa HP kamu: " + pemain.hp);
        }

        System.out.println("\n=== HASIL AKHIR ===");
        if (pemain.kalah()) {
            System.out.println("Kamu kalah. " + lawan.nama + " menang!");
        } else {
            System.out.println("Kamu menang! " + pemain.nama + " berhasil mengalahkan " + lawan.nama + ".");
        }

        input.close();
    }
}
