public class App {
    public static void main(String[] args) throws Exception {
        while (true) {
            System.out.println("=== Clash Royale ===");
            System.out.println("1. Play \n2. Exit");
            System.out.print(">> ");
            int pil = Game.scanner.nextInt();
            switch (pil) {
                case 1 -> Game.game();
                case 2 -> System.exit(0);
                default -> System.out.println("ulang yg bener");
            }
        }
    }
}
