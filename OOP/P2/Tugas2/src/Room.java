public class Room {

    public boolean owned, status;
    public int price, rentDuration, dayRented, payment;
    public String tenant;

    public Room(boolean owned, int price, boolean status, String tenant, int rentDuration, int dayRented, int payment) {
        this.owned = owned;
        this.price = price;
        this.status = status;
        this.tenant = tenant;
        this.rentDuration = rentDuration;
        this.dayRented = dayRented;
        this.payment = payment;
    }

    public String getStatus() {
        if (!owned)
            return "Not Owned (Price: $" + price +")";

        return status ? ("Occupied by " + tenant + " (Day " + dayRented + "/" + rentDuration + ")") : "Empty";
    }

    public String getStatusBuyRoom() {

        if (owned)
            return "(Already Owned)";
        else
            return "";

    }

}
