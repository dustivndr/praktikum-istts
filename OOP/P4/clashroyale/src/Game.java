
import card.*;
import java.util.*;

public class Game {

    public static Scanner scanner = new Scanner(System.in);
    public static Random random = new Random();
    public static Troop[] troops = {
        new Troop("Goblins", 3, 1, 2),
        new Troop("Elixir Golem", 5, 2, 3),
        new Troop("Bomber", 4, 3, 4)
    };

    public static void game() {
        
        int elixir = 5;
        int ept1 = 10, ept2 = 10, ekt = 20;
        int ppt1 = 10, ppt2 = 10, pkt = 20;
        
        while (true) {

            int troopIndex = random.nextInt(troops.length);
            Troop randomTroop = troops[troopIndex];

            System.out.println();
            System.out.println("==========================");
            System.out.println("|      CLASH ROYALE      |");
            System.out.println("==========================");
            System.out.println("|        [Enemy]         |");
            System.out.println("| [PT]     [KT]     [PT] |");
            System.out.println("| ["+ept1+"]     ["+ekt+"]     ["+ept2+"] |");
            System.out.println("|                        |");
            System.out.println("--------- RIVER ----------");
            System.out.println("|                        |");
            System.out.println("| ["+ppt1+"]     ["+pkt+"]     ["+ppt2+"] |");
            System.out.println("| [PT]     [KT]     [PT] |");
            System.out.println("|        [Player]        |");
            System.out.println("==========================");
            System.out.println("Elixir: " + elixir + "/10");
            System.out.println("Choose a card:");
            
            System.out.print("1. ");
            randomTroop.displayForSelect();
            System.out.println();

            System.out.print("2. ");
            System.out.println();

            System.out.print("3. ");
            System.out.println();

            System.out.println("4. Skip Turn");
            System.out.print(">> ");
            int pil = scanner.nextInt();

            switch (pil) {
                case 1 -> {}
                case 2 -> {}
                case 3 -> {}
                case 4 -> {}
                case 10 -> elixir = 10;
                default -> System.out.println("Input yg bener");
            }

        }

    }

}
