import java.util.Scanner;

public class App {

    public static Scanner sc = new Scanner(System.in);
    
    public static void main(String[] args) throws Exception {

        while (true) { 

            System.out.println("===================");
            System.out.println(" MAGIC CHESS GO GO ");
            System.out.println("===================");
            System.out.println("1. Start Game \n2. Exit");
            System.out.print(">> ");
            String choice = sc.nextLine().trim();
    
            switch (choice) {
                case "1" -> {
                    System.out.print("Player 1, enter your name: ");
                    String player1name = sc.nextLine().trim();
    
                    System.out.print("Player 2, enter your name: ");
                    String player2name = sc.nextLine().trim();

                    Player player1 = new Player(player1name);
                    Player player2 = new Player(player2name);
                    
                    System.out.println("\n\n");
                    Game.loop(player1, player2);
                }
                case "2" ->
                    System.exit(0);
                default -> 
                    System.out.println("Invalid option");
            }

        }

    }
}
