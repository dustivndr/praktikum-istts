import java.util.ArrayList;

public class Repository<T> {

    private final ArrayList<T> database;

    public Repository() {
        this.database = new ArrayList<>();
    }


    public void add(T data) {
        database.add(data);
    }

    public T get(int index) {
        if (index >= 0 && index < database.size()) {
            return database.get(index);
        }
        return null;
    }

    public ArrayList<T> getAll() {
        return database;
    }

    public int size() {
        return database.size();
    }

    public T remove(int index) {
        if (index >= 0 && index < database.size()) {
            return database.remove(index);
        }
        return null;
    }

    public boolean contains(T data) {
        return database.contains(data);
    }

    public int indexOf(T data) {
        return database.indexOf(data);
    }

    public void clear() {
        database.clear();
    }

}
