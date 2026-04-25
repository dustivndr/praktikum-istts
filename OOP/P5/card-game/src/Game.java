
public class Game {

    public static void game() {

        playerCardSelect(1);
        playerCardSelect(2);

    }

    public static void playerCardSelect(int player) {

        while (true) {

            System.out.println("Choose 3 Cards for Player " + player);
            System.out.println("1. Pyro Maniac - Fire");
            System.out.println("2. Atlantic Siren - Water");
            System.out.println("3. Stone Golem - Flora");
            System.out.println("4. Holy Paladin - Light");
            System.out.println("5. Grim Reaper - Dark");
            System.out.print(">> ");
            String cardSelect = App.scanner.nextLine();

            if (!cardSelect.contains(",")) {
                System.out.println("Invalid input");
                continue;
            }

            String[] parts = cardSelect.split(",");

            if (parts.length != 3) {
                System.out.println("You must choose 3 cards. No more, no less.");
                continue;
            }

            int[] numbers = new int[3];
            // boolean validFormat = true;

            for (int i = 0; i < 3; i++) {
                String part = parts[i].trim();

                if (part.length() != 1 || !Character.isDigit(part.charAt(0))) {
                    // validFormat = false;
                    break;
                }

                int num = part.charAt(0) - '0';

                if (num < 1 || num > 5) {
                    System.out.println("Invalid card choice(s). Please choose card numbers between 1 and 5.");
                    // validFormat = false;
                    break;
                }

                numbers[i] = num;
            }

//            if (!validFormat) {
//                if (!cardSelect.matches(".*\\d.*")) { // optional fallback
//                    System.out.println("invalid input");
//                }
//                continue;
//            }

            if (numbers[0] == numbers[1] ||
                    numbers[0] == numbers[2] ||
                    numbers[1] == numbers[2]) {
                System.out.println("There are duplicate card choices.");
                continue;
            }

            // Valid
            System.out.println("Valid input accepted!");
            break;

        }

    } // close player card selector

}
