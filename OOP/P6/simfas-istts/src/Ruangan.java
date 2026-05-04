
public class Ruangan {
    private String name;
    private String status;
    private String handler;

    public Ruangan(String name, String status, String handler) {
        this.name = name;
        this.status = status == null || status.isEmpty() ? "Available" : status;
        this.handler = handler == null || handler.isEmpty() ? "x" : handler;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getHandler() {
        return handler;
    }

    public void setHandler(String handler) {
        this.handler = handler == null || handler.isEmpty() ? "x" : handler;
    }

    @Override
    public String toString() {
        return name + " (" + status + ") - " + (handler == null || handler.isEmpty() ? "x" : handler);
    }
}
