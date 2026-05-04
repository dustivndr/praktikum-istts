
public class Barang {

    private String name;
    private int stock;
    private String handler;

    public Barang(String name, int stock) {
        this.name = name;
        this.stock = stock;
        this.handler = "x";
    }

    public Barang(String name, int stock, String handler) {
        this.name = name;
        this.stock = stock;
        this.handler = handler == null || handler.isEmpty() ? "x" : handler;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getStock() {
        return stock;
    }

    public void setStock(int stock) {
        this.stock = stock;
    }

    public String getHandler() {
        return handler;
    }

    public void setHandler(String handler) {
        this.handler = handler == null || handler.isEmpty() ? "x" : handler;
    }

    @Override
    public String toString() {
        return name + " (" + stock + "x)" + " – " + (handler == null || handler.isEmpty() ? "x" : handler);
    }

}
