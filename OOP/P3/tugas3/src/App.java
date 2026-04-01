public class App {

    public static void main(String[] args) throws Exception {
        while (true) { 
            switch (mainMenu()) {
                case 1 -> Game.render();
                case 2 -> System.exit(0);
                default -> System.out.println("Invalid input");
            }
        }
    }

    public static int mainMenu() {
        System.out.println("=======================");
        System.out.println("|      DINNER DASH    |");
        System.out.println("=======================");
        System.out.println("1. Start Game \n2. Exit");
        System.out.print(">> ");

        String input = Game.scanner.nextLine().trim();
        if (input.equals("1")) return 1;
        if (input.equals("2")) return 2;
        return -1;
    }

}
