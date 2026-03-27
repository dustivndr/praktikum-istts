import java.util.Scanner;

public class Game {

    public static Scanner scanner = new Scanner(System.in);

    public static int gold = 0;

    public static void render() {

        char[][] map = new char[7][21];
        for (int i = 0 ; i <= 6 ; i++){
            for (int j = 0 ; j <= 20 ; j++) {
                if (i==0 || i==6) 
                    map[i][j] = '=';
                else if (j==0 || j==20)
                    map[i][j] = '|';
                else
                    map[i][j] = ' ';

                if (((i >= 2 && i <= 4) && (j >= 4 && j <= 8) && (i == 2 || i == 4 || j == 4 || j == 8))
                        || ((i >= 2 && i <= 4) && (j >= 12 && j <= 16) && (i == 2 || i == 4 || j == 12 || j == 16)))
                    map[i][j] = '#';
            }
        }

        map[3][6] = '1';
        map[3][14] = '2';

        map[1][1] = 'P';
        map[5][1] = 'D';
        map[1][19] = 'K';

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
            System.out.println("=====================");
            System.out.println("move (wasd) | quit (x) | expand shop (e)");
            System.out.print(">> ");
            String choose = scanner.nextLine().toLowerCase();

            if (choose.length() < 2) {

                if (choose.equals("x")) {
                    break;
                }

            } else {
                System.out.println("Input harus sesuai");
            }

        }
        
    }

    public static void printMap(char[][] map) {
        for (char[] map1 : map) {
            for (int j = 0; j < map1.length; j++) {
                System.out.print(map1[j]);
            }
            System.out.println();
        }
    }
    
}
