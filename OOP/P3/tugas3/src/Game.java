import java.util.ArrayList;
import java.util.Scanner;

public class Game {

    public static Scanner scanner = new Scanner(System.in);

    public static int gold = 0;

    public static void render() {
        gold = 0;
        boolean isShopExpanded = false;
        ArrayList<ArrayList<Character>> map = buildMap(isShopExpanded);

        while (true) { 
            
            System.out.println();
            System.out.println("=====================");
            System.out.println("|    DINNER DASH    |");
            printMap(map);
            System.out.println("Gold: " + gold);
            System.out.println("Active");
            System.out.println("=====================");
            System.out.println("Table 1 = " + "/4 | Status: ");
            System.out.println("Table 2 = " + "/4 | Status: ");
            if (isShopExpanded) {
                System.out.println("Table 3 = " + "/4 | Status: ");
                System.out.println("Table 4 = " + "/4 | Status: ");
            }
            System.out.println("=====================");
            System.out.println("move (wasd) | quit (x) | expand shop (e)");
            System.out.print(">> ");
            String choose = scanner.nextLine().toLowerCase();

            if (choose.length() != 1) {
                System.out.println("Input harus sesuai");
            } else {
                switch (choose) {
                    case "x" -> {
                        System.out.println();
                        return;
                    }
                    case "e" -> {
                        if (isShopExpanded) {
                            System.out.println("\nShop is already expanded.");
                        } else if (gold >= 100) {
                            gold -= 100;
                            isShopExpanded = true;
                            map = buildMap(true);
                            System.out.println("\nShop expanded! 2 new tables added!");
                        } else {
                            System.out.println("\nNot enough gold to expand shop. Need at least 100 gold.");
                        }
                    }
                    case "g" -> {
                        gold += 100;
                    }
                    default -> {
                    }
                }
            }

        }
        
    }

    public static ArrayList<ArrayList<Character>> buildMap(boolean isShopExpanded) {
        int totalRows = isShopExpanded ? 11 : 7;
        int totalCols = 21;

        ArrayList<ArrayList<Character>> map = new ArrayList<>();
        for (int i = 0; i < totalRows; i++) {
            ArrayList<Character> row = new ArrayList<>();
            for (int j = 0; j < totalCols; j++) {
                char value;
                if (i == 0 || i == totalRows - 1) {
                    value = '=';
                } else if (j == 0 || j == totalCols - 1) {
                    value = '|';
                } else {
                    value = ' ';
                }
                row.add(value);
            }
            map.add(row);
        }

        drawTable(map, 2, 4, '1');
        drawTable(map, 2, 12, '2');

        if (isShopExpanded) {
            drawTable(map, 6, 4, '3');
            drawTable(map, 6, 12, '4');
        }

        map.get(1).set(1, 'P');
        map.get(1).set(19, 'K');
        map.get(totalRows - 2).set(1, 'D');

        return map;
    }

    public static void drawTable(ArrayList<ArrayList<Character>> map, int startRow, int startCol, char tableNumber) {
        for (int i = startRow; i <= startRow + 2; i++) {
            for (int j = startCol; j <= startCol + 4; j++) {
                if (i == startRow || i == startRow + 2 || j == startCol || j == startCol + 4) {
                    map.get(i).set(j, '#');
                }
            }
        }
        map.get(startRow + 1).set(startCol + 2, tableNumber);
    }

    public static void printMap(ArrayList<ArrayList<Character>> map) {
        for (ArrayList<Character> row : map) {
            for (int j = 0; j < row.size(); j++) {
                System.out.print(row.get(j));
            }
            System.out.println();
        }
    }

    public static void moveUp() {

    }

    public static void moveDown() {

    }

    public static void moveLeft() {

    }

    public static void moveRight() {

    }
    
}
