import java.util.Scanner;

public class App {

    public static int pil;
    public static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) throws Exception {
        
        while (true) { 
            programMenu();
            mainMenu();
        }

    } // close psvm

    public static void programMenu() {

        System.out.println("================");
        System.out.println("| RENT PLEASE! |");
        System.out.println("================");
        System.out.println("1. Play \n2. Exit");
        System.out.print(">> ");
        pil = scanner.nextInt();
        
        switch (pil) {
            case 1 -> System.out.println();
            case 2 -> System.exit(0);
            default -> System.out.println("yang bener lah");
        }

    } // close psv programMenu

    public static void mainMenu() {

        Room room1 = new Room(false, 200, false, "", 0, 0, 0);
        Room room2 = new Room(false, 300, false, "", 0, 0, 0);
        Room room3 = new Room(false, 400, false, "", 0, 0, 0);

        while (true) { 
            System.out.println("=================");
            System.out.println("Day: " + User.dayCounter);
            System.out.println("Money: $" + User.money);
            System.out.println("=================");
            System.out.println("Room 1: " + room1.getStatus());
            System.out.println("Room 2: " + room2.getStatus());
            System.out.println("Room 3: " + room3.getStatus());
            System.out.println("=================");
            System.out.println("1. Buy Room");
            System.out.println("2. Check Potential Renters");
            System.out.println("3. Check Room Status");
            System.out.println("4. Next Day");
            System.out.println("0. Exit");
            System.out.print(">> ");
            pil = scanner.nextInt();
    
            switch (pil) {
                case 0 -> {System.out.println();return;}
                case 1 -> Menu.buyRoom(room1, room2, room3);
                case 2 -> Menu.checkPotentialRenters(room1, room2, room3);
                case 3 -> Menu.checkRoomStatus(room1, room2, room3);
                case 4 -> User.dayCounter++;
                default -> System.out.println("yang bener lah");
            }
        }

    } // close psv mainMenu
}
