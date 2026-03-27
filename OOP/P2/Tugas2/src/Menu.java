
import java.util.Random;
import java.util.Scanner;

public class Menu {

    public static int pil;
    public static Scanner scanner = new Scanner(System.in);
    public static Random random = new Random();
    
    public static void buyRoom(Room room1, Room room2, Room room3) {

        System.out.println("\n=== BUY ROOM ===");
        System.out.println("1. Room 1 - $200 " + room1.getStatusBuyRoom());
        System.out.println("2. Room 2 - $300 " + room2.getStatusBuyRoom());
        System.out.println("3. Room 3 - $400 " + room3.getStatusBuyRoom());
        System.out.println("4. Cancel");
        System.out.print(">> ");
        pil = scanner.nextInt();

        switch (pil) {
            case 1 -> {
                if (room1.owned == false && User.money >= room1.price) {
                    User.money -= room1.price;
                    room1.owned = true;
                    System.out.println("Successfully bought Room 1!\n");
                    break;
                }
                else if (room1.owned == true) {
                    System.out.println("You already owned this room!\n"); 
                    break;
                }
                else if (User.money < room1.price) {
                    System.out.println("Not enough money left to buy!\n");
                }
            }
            case 2 -> {
                if (room2.owned == false && User.money >= room2.price) {
                    User.money -= room2.price;
                    room2.owned = true;
                    System.out.println("Successfully bought Room 2!\n");
                    break;
                }
                else if (room2.owned == true) {
                    System.out.println("You already owned this room!\n"); 
                    break;
                }
                else if (User.money < room2.price) {
                    System.out.println("Not enough money left to buy!\n");
                }
            }
            case 3 -> {
                if (room3.owned == false && User.money >= room3.price) {
                    User.money -= room3.price;
                    room3.owned = true;
                    System.out.println("Successfully bought Room 3!\n");
                    break;
                }
                else if (room3.owned == true) {
                    System.out.println("You already owned this room!\n"); 
                    break;
                }
                else if (User.money < room3.price) {
                    System.out.println("Not enough money left to buy!\n");
                }
            }
            case 4 -> System.out.println("Purchase cancelled.\n");
            default -> System.out.println("yang bener lah\n");
        }

    } // close psv buyRoom

    public static void checkPotentialRenters(Room room1, Room room2, Room room3) {

        System.out.println("\n=== POTENTIAL RENTERS ===");

        if ((room1.status || !room1.owned) && (room2.status || !room2.owned) && (room3.status || !room3.owned)) {
            System.out.println("No empty rooms available for rent!\n");
            return;
        }

        System.out.println("Found a potential renter!");
        String[] names = {"Anna", "Bowo", "Coco", "Didi", "Emma", "Fufu", "Gigi", "Haji", "Ian"};
        String tenantName = names[random.nextInt(names.length)];
        int rentPrice = 50 + (random.nextInt(6) * 10);
        int rentDuration = 1 + (random.nextInt(5));
        System.out.println("Name: " + tenantName + " Rent Price: $" + rentPrice + " per " + rentDuration + " days\n");

        System.out.println("Select a room to rent:");
        int option = 1;
        int optRoom1 = -1;
        int optRoom2 = -1;
        int optRoom3 = -1;

        if (room1.owned && !room1.status) {
            optRoom1 = option;
            System.out.println(option + ". Room 1");
            option++;
        }
        if (room2.owned && !room2.status) {
            optRoom2 = option;
            System.out.println(option + ". Room 2");
            option++;
        }
        if (room3.owned && !room3.status) {
            optRoom3 = option;
            System.out.println(option + ". Room 3");
            option++;
        }
        System.out.println("0. Cancel");
        System.out.print(">> ");
        pil = scanner.nextInt();

        if (pil == 0) {
            System.out.println("Rent cancelled.\n");
            return;
        }

        if (pil < 1 || pil >= option) {
            System.out.println("Invalid room selection!\n");
            return;
        }

        Room selectedRoom;
        int selectedRoomNumber;

        if (pil == optRoom1) {
            selectedRoom = room1;
            selectedRoomNumber = 1;
        }
        else if (pil == optRoom2) {
            selectedRoom = room2;
            selectedRoomNumber = 2;
        }
        else if (pil == optRoom3) {
            selectedRoom = room3;
            selectedRoomNumber = 3;
        }
        else {
            System.out.println("Invalid room selection!\n");
            return;
        }

        selectedRoom.status = true;
        selectedRoom.tenant = tenantName;
        selectedRoom.rentDuration = rentDuration;
        selectedRoom.dayRented = 0;
        selectedRoom.payment = rentPrice;

        System.out.println(tenantName + " has moved into Room " + selectedRoomNumber + "!\n");

    } // close psv checkPotentialRenters

    public static void checkRoomStatus(Room room1, Room room2, Room room3) {

        System.out.println("\n=== ROOM STATUS ===\n");

        if (room1.owned) {
            if (room1.status) {
                System.out.println("Room 1:");
                System.out.println("  Tenant: " + room1.tenant);
                System.out.println("  Rent Duration: " + room1.rentDuration + " days");
                System.out.println("  Days Rented: " + room1.dayRented + " days");
                System.out.println("  Payment: $" + room1.payment + "/day");
                System.out.println("  Status: Occupied\n");
            }
            else {
                System.out.println("Room 1:");
                System.out.println("  Status: Empty\n");
            }
        }
        else {
            System.out.println("Room 1: Not Owned\n");
        }

        if (room2.owned) {
            if (room2.status) {
                System.out.println("Room 2:");
                System.out.println("  Tenant: " + room2.tenant);
                System.out.println("  Rent Duration: " + room2.rentDuration + " days");
                System.out.println("  Days Rented: " + room2.dayRented + " days");
                System.out.println("  Payment: $" + room2.payment + "/day");
                System.out.println("  Status: Occupied\n");
            }
            else {
                System.out.println("Room 2:");
                System.out.println("  Status: Empty\n");
            }
        }
        else {
            System.out.println("Room 2: Not Owned\n");
        }

        if (room3.owned) {
            if (room3.status) {
                System.out.println("Room 3:");
                System.out.println("  Tenant: " + room3.tenant);
                System.out.println("  Rent Duration: " + room3.rentDuration + " days");
                System.out.println("  Days Rented: " + room3.dayRented + " days");
                System.out.println("  Payment: $" + room3.payment + "/day");
                System.out.println("  Status: Occupied\n");
            }
            else {
                System.out.println("Room 3:");
                System.out.println("  Status: Empty\n");
            }
        }
        else {
            System.out.println("Room 3: Not Owned\n");
        }
        
    } // close psv checkRoomStatus

    public static void nextDay(Room room1, Room room2, Room room3) {

        User.dayCounter++;

        boolean hasFinishedTenant =
            (room1.status && room1.dayRented + 1 >= room1.rentDuration) ||
            (room2.status && room2.dayRented + 1 >= room2.rentDuration) ||
            (room3.status && room3.dayRented + 1 >= room3.rentDuration);

        if (hasFinishedTenant) {
            System.out.println("=== DAY " + User.dayCounter + " ===");
        }

        if (room1.status) {
            room1.dayRented++;
            if (room1.dayRented >= room1.rentDuration) {
                User.money += room1.payment * room1.rentDuration;
                System.out.println("Room 1 - " + room1.tenant + " paid $" + (room1.payment * room1.rentDuration));
                System.out.println(room1.tenant + " has finised renting and moved out from Room 1!\n");
                room1.status = false;
                room1.tenant = "";
                room1.rentDuration = 0;
                room1.dayRented = 0;
                room1.payment = 0;
            }
        }

        if (room2.status) {
            room2.dayRented++;
            if (room2.dayRented >= room2.rentDuration) {
                User.money += room2.payment * room2.rentDuration;
                System.out.println("Room 2 - " + room2.tenant + " paid $" + (room2.payment * room2.rentDuration));
                System.out.println(room2.tenant + " has finised renting and moved out from Room 2!\n");
                room2.status = false;
                room2.tenant = "";
                room2.rentDuration = 0;
                room2.dayRented = 0;
                room2.payment = 0;
            }
        }

        if (room3.status) {
            room3.dayRented++;
            if (room3.dayRented >= room3.rentDuration) {
                User.money += room3.payment * room3.rentDuration;
                System.out.println("Room 3 - " + room3.tenant + " paid $" + (room3.payment * room3.rentDuration));
                System.out.println(room3.tenant + " has finised renting and moved out from Room 3!\n");
                room3.status = false;
                room3.tenant = "";
                room3.rentDuration = 0;
                room3.dayRented = 0;
                room3.payment = 0;
            }
        }

        System.out.println();

    } // close psv nextDay

}
