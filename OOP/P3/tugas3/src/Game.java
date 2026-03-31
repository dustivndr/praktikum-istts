import java.util.ArrayList;
import java.util.Random;
import java.util.Scanner;

public class Game {

    public static Scanner scanner = new Scanner(System.in);

    public static int gold = 0;
    public static ArrayList<ArrayList<Character>> currentMap;
    public static int playerRow;
    public static int playerCol;
    public static boolean isShopExpanded;
    public static int pendingCustomers;
    public static int[] tableCustomers = new int[5];
    public static int[] tablePatience = new int[5];
    public static String[] tableOrders = new String[5];
    public static String carryingFoodName = "";
    public static int carryingFoodAmount = 0;
    public static Random random = new Random();
    public static final String[] MENU_ITEMS = { "Hamburger", "Fries", "Fried Chicken" };

    public static final int[][] TABLE_STARTS = {
        { 0, 0 },
        { 2, 4 },
        { 2, 12 },
        { 6, 4 },
        { 6, 12 }
    };

    public static void render() {
        gold = 0;
        isShopExpanded = false;
        pendingCustomers = 0;
        carryingFoodName = "";
        carryingFoodAmount = 0;
        for (int i = 1; i < tableCustomers.length; i++) {
            tableCustomers[i] = 0;
            tablePatience[i] = 0;
            tableOrders[i] = "";
        }

        ArrayList<ArrayList<Character>> map = buildMap(isShopExpanded);
        currentMap = map;
        playerRow = 1;
        playerCol = 1;

        while (true) { 
            
            System.out.println();
            System.out.println("=====================");
            System.out.println("|    DINNER DASH    |");
            printMap(map);
            System.out.println("Gold: " + gold);
            System.out.println("Active: " + getActiveStatus());
            System.out.println("=====================");
            printTableInfo(1);
            printTableInfo(2);
            if (isShopExpanded) {
                printTableInfo(3);
                printTableInfo(4);
            }
            System.out.println("=====================");
            String menu = "move (wasd) | quit (x) | expand shop (e)";
            if (canSeatCustomers()) {
                menu += " | seat (t)";
            }
            if (canServeFood()) {
                menu += " | serve (v)";
            }
            System.out.println(menu);
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
                            currentMap = map;
                            playerRow = 1;
                            playerCol = 1;
                            redrawCustomerMarkers();
                            System.out.println("\nShop expanded! 2 new tables added!");
                        } else {
                            System.out.println("\nNot enough gold to expand shop. Need at least 100 gold.");
                        }
                    }
                    case "g" -> gold += 100;
                    case "w" -> moveUp();
                    case "s" -> moveDown();
                    case "a" -> moveLeft();
                    case "d" -> moveRight();
                    case "t" -> trySeatCustomers();
                    case "v" -> tryServeFood();
                    default -> System.out.println("Invalid input!\n");
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
                if (i == 0 || i == totalRows - 1)
                    value = '=';
                else if (j == 0 || j == totalCols - 1)
                    value = '|';
                else
                    value = ' ';
                
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
        moveTo(playerRow - 1, playerCol);
    }

    public static void moveDown() {
        moveTo(playerRow + 1, playerCol);
    }

    public static void moveLeft() {
        moveTo(playerRow, playerCol - 1);
    }

    public static void moveRight() {
        moveTo(playerRow, playerCol + 1);
    }

    public static void moveTo(int targetRow, int targetCol) {
        if (currentMap == null)
            return;

        if (targetRow < 0 || targetRow >= currentMap.size())
            return;

        if (targetCol < 0 || targetCol >= currentMap.get(targetRow).size())
            return;

        char targetCell = currentMap.get(targetRow).get(targetCol);

        if (targetCell == 'D') {
            tryReceiveCustomers();
            return;
        }

        if (targetCell == 'K') {
            openKitchenMenu();
            return;
        }

        if (targetCell != ' ')
            return;

        currentMap.get(playerRow).set(playerCol, ' ');
        currentMap.get(targetRow).set(targetCol, 'P');
        playerRow = targetRow;
        playerCol = targetCol;

        decreasePatienceOnMove();
    }

    public static String getActiveStatus() {
        if (carryingFoodAmount > 0 && !carryingFoodName.isEmpty()) {
            return "Carrying " + carryingFoodName + " x" + carryingFoodAmount;
        }
        if (pendingCustomers > 0) {
            return "Receiving " + pendingCustomers + " customer(s)";
        }
        return "nothing";
    }

    public static void printTableInfo(int tableId) {
        int customerCount = tableCustomers[tableId];
        String status = customerCount == 0 ? "Empty" : "waiting";
        System.out.println("Table " + tableId + " = " + customerCount + "/4 | Status: " + status);
        if (customerCount > 0) {
            System.out.println("  - Customer patience: " + tablePatience[tableId]);
            System.out.println("  - Order: " + tableOrders[tableId] + " x" + customerCount);
        }
    }

    public static void tryReceiveCustomers() {
        if (pendingCustomers > 0) {
            return;
        }

        if (!hasEmptyTable()) {
            System.out.println("No empty table available.");
            return;
        }

        pendingCustomers = random.nextInt(4) + 1;
        System.out.println("Received " + pendingCustomers + " customer(s)!");
    }

    public static boolean hasEmptyTable() {
        int lastTable = isShopExpanded ? 4 : 2;
        for (int i = 1; i <= lastTable; i++) {
            if (tableCustomers[i] == 0) {
                return true;
            }
        }
        return false;
    }

    public static boolean canSeatCustomers() {
        if (pendingCustomers == 0) {
            return false;
        }
        return findAdjacentEmptyTable() != -1;
    }

    public static int findAdjacentEmptyTable() {
        int lastTable = isShopExpanded ? 4 : 2;
        for (int tableId = 1; tableId <= lastTable; tableId++) {
            if (tableCustomers[tableId] == 0 && isPlayerAdjacentToTable(tableId)) {
                return tableId;
            }
        }
        return -1;
    }

    public static boolean isPlayerAdjacentToTable(int tableId) {
        int startRow = TABLE_STARTS[tableId][0];
        int startCol = TABLE_STARTS[tableId][1];

        boolean topSide = playerRow == startRow - 1 && playerCol >= startCol && playerCol <= startCol + 4;
        boolean bottomSide = playerRow == startRow + 3 && playerCol >= startCol && playerCol <= startCol + 4;
        boolean leftSide = playerCol == startCol - 1 && playerRow >= startRow && playerRow <= startRow + 2;
        boolean rightSide = playerCol == startCol + 5 && playerRow >= startRow && playerRow <= startRow + 2;

        return topSide || bottomSide || leftSide || rightSide;
    }

    public static void trySeatCustomers() {
        int targetTable = findAdjacentEmptyTable();
        if (pendingCustomers == 0 || targetTable == -1) {
            return;
        }

        tableCustomers[targetTable] = pendingCustomers;
        tablePatience[targetTable] = generateCustomerPatience();
        tableOrders[targetTable] = generateOrder();
        placeCustomerMarker(targetTable);
        pendingCustomers = 0;
    }

    public static void openKitchenMenu() {
        System.out.println("\n=== Kitchen ===");
        System.out.println("1. Hamburger");
        System.out.println("2. Fries");
        System.out.println("3. Fried Chicken");
        System.out.print(">> ");

        String foodInput = scanner.nextLine().trim();
        int foodChoice;
        try {
            foodChoice = Integer.parseInt(foodInput);
        } catch (NumberFormatException e) {
            System.out.println("Invalid menu choice.");
            return;
        }

        if (foodChoice < 1 || foodChoice > 3) {
            System.out.println("Invalid menu choice.");
            return;
        }

        System.out.print("Amount: ");
        String amountInput = scanner.nextLine().trim();
        int amount;
        try {
            amount = Integer.parseInt(amountInput);
        } catch (NumberFormatException e) {
            System.out.println("Invalid amount.");
            return;
        }

        if (amount <= 0) {
            System.out.println("Amount must be more than 0.");
            return;
        }

        carryingFoodName = MENU_ITEMS[foodChoice - 1];
        carryingFoodAmount = amount;
    }

    public static boolean canServeFood() {
        return findAdjacentOccupiedTable() != -1;
    }

    public static int findAdjacentOccupiedTable() {
        int lastTable = isShopExpanded ? 4 : 2;
        for (int tableId = 1; tableId <= lastTable; tableId++) {
            if (tableCustomers[tableId] > 0 && isPlayerAdjacentToTable(tableId)) {
                return tableId;
            }
        }
        return -1;
    }

    public static void tryServeFood() {
        int targetTable = findAdjacentOccupiedTable();
        if (targetTable == -1 || carryingFoodAmount <= 0 || carryingFoodName.isEmpty()) {
            return;
        }

        if (tableOrders[targetTable].equals(carryingFoodName)) {
            int customerCount = tableCustomers[targetTable];
            clearTable(targetTable);
            gold += customerCount * 10;
            carryingFoodName = "";
            carryingFoodAmount = 0;
            System.out.println("\nFood served successfully");
            return;
        }

        tablePatience[targetTable] = Math.max(0, tablePatience[targetTable] - 5);
        System.out.println("Wrong Food!");
        if (tablePatience[targetTable] == 0) {
            clearTable(targetTable);
            gold = Math.max(0, gold - 10);
            System.out.println("Table " + targetTable + " customers left! Gold -10.");
        }
    }

    public static int generateCustomerPatience() {
        return (random.nextInt(3) + 3) * 10;
    }

    public static String generateOrder() {
        return MENU_ITEMS[random.nextInt(MENU_ITEMS.length)];
    }

    public static void decreasePatienceOnMove() {
        int lastTable = isShopExpanded ? 4 : 2;
        for (int tableId = 1; tableId <= lastTable; tableId++) {
            if (tableCustomers[tableId] == 0)
                continue;

            tablePatience[tableId]--;
            if (tablePatience[tableId] <= 0) {
                clearTable(tableId);
                gold = Math.max(0, gold - 10);
                System.out.println("Table " + tableId + " customers left! Gold -10.");
            }
        }
    }

    public static void clearTable(int tableId) {
        tableCustomers[tableId] = 0;
        tablePatience[tableId] = 0;
        tableOrders[tableId] = "";
        clearCustomerMarkers(tableId);
    }

    public static void clearCustomerMarkers(int tableId) {
        int startRow = TABLE_STARTS[tableId][0];
        int startCol = TABLE_STARTS[tableId][1];
        int[][] markerPositions = {
            { startRow, startCol - 1 },
            { startRow, startCol + 5 },
            { startRow + 2, startCol - 1 },
            { startRow + 2, startCol + 5 }
        };

        for (int[] pos : markerPositions) {
            int r = pos[0];
            int c = pos[1];
            if (r < 0 || r >= currentMap.size())
                continue;
            if (c < 0 || c >= currentMap.get(r).size())
                continue;
            if (currentMap.get(r).get(c) == 'C') {
                currentMap.get(r).set(c, ' ');
            }
        }
    }

    public static void placeCustomerMarker(int tableId) {
        int startRow = TABLE_STARTS[tableId][0];
        int startCol = TABLE_STARTS[tableId][1];

        // Top row: row = startRow, Bottom row: row = startRow + 2
        int[][] candidatePositions = {
            { startRow, startCol - 1 },           // top-left
            { startRow, startCol + 5 },           // top-right
            { startRow + 2, startCol - 1 },       // bottom-left
            { startRow + 2, startCol + 5 }        // bottom-right
        };

        int customersToPlace = tableCustomers[tableId];
        int placed = 0;

        for (int[] pos : candidatePositions) {
            if (placed >= customersToPlace) break;
            
            int r = pos[0];
            int c = pos[1];
            
            if (r < 0 || r >= currentMap.size())
                continue;
            if (c < 0 || c >= currentMap.get(r).size())
                continue;
            if (r == playerRow && c == playerCol)
                continue;
            if (currentMap.get(r).get(c) == ' ') {
                currentMap.get(r).set(c, 'C');
                placed++;
            }
        }
    }

    public static void redrawCustomerMarkers() {
        int lastTable = isShopExpanded ? 4 : 2;
        for (int tableId = 1; tableId <= lastTable; tableId++) {
            if (tableCustomers[tableId] > 0) {
                placeCustomerMarker(tableId);
            }
        }
    }
    
}
