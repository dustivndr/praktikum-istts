public class App {
    public static void main(String[] args) throws Exception {
        while (true) {
            System.out.println("=== Clash Royale ===");
            System.out.println("1. Play \n2. Exit");
            System.out.print(">> ");
            // just in case kalo ada error null pointer exception, soalnya kadang bisa kadang engga ni terminal vscode
            // if (Game.scanner == null) {
            //     Game.scanner = new java.util.Scanner(System.in);
            // }
            int pil = Game.scanner.nextInt();
            switch (pil) {
                case 1 -> Game.game();
                case 2 -> System.exit(0);
                default -> System.out.println("Please enter a valid input");
            }
        }
    }
}
