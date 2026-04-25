import java.util.*;

public class App {

    public static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {

        boolean play = true;
        while (true) {

            System.out.println("== Dummy Invoc TCG ==");
            System.out.println(play ? "> Play" : " Play");
            System.out.println(!play ? "> Exit" : " Exit");
            String move = scanner.nextLine().toLowerCase();

            switch (move) {
                case "w" -> play = true;
                case "s" -> play = false;
                case "" -> {
                    if (!play)
                        System.exit(0);
                    else
                        Game.game();
                }
                default -> {
                    return;
                }
            }

            System.out.println();
        }

    }

}
