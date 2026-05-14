
import java.util.ArrayList;
import java.util.List;

public class Player {

    private final String name;
    private int gold, level, hp;
    private final List<Hero> inventory; 
    private final Hero[] board; 

    public Player(String name) {
        this.name = name;
        this.gold = 10;
        this.level = 2;
        this.hp = 10;
        this.inventory = new ArrayList<>();
        this.board = new Hero[8];
    }

    public String getName() {
        return name;
    }

    public int getGold() {
        return gold;
    }

    public void addGold(int amount) {
        this.gold += amount;
    }

    public boolean spendGold(int amount) {
        if (amount <= gold) {
            gold -= amount;
            return true;
        }
        return false;
    }

    public int getLevel() {
        return level;
    }

    public void levelUp() {
        this.level += 1;
    }

    public int getHp() {
        return hp;
    }

    public void adjustHp(int delta) {
        this.hp += delta;
        if (this.hp < 0) {
            this.hp = 0;
        }
    }

    public List<Hero> getInventory() {
        return inventory;
    }

    public boolean addToInventory(Hero h) {
        if (inventory.size() >= 6) {
            return false;
        }

        inventory.add(h);
        return true;
    }

    public Hero removeFromInventory(int idx) {
        if (idx < 0 || idx >= inventory.size()) {
            return null;
        }

        return inventory.remove(idx);
    }

    public Hero[] getBoard() {
        return board;
    }

    public int boardCount() {
        int c = 0;
        for (Hero h : board) {
            if (h != null) {
                c++;
            }
        }
        return c;
    }

    public int boardLimit() {
        return level;
    }

    public boolean placeToBoard(Hero h, int slot) {
        if (h == null) {
            return false;
        }
        if (boardCount() >= boardLimit()) {
            return false;
        }
        if (slot < 0 || slot >= board.length) {
            return false;
        }
        if (board[slot] != null) {
            return false;
        }

        board[slot] = h;
        return true;
    }

    public Hero removeFromBoard(int slot) {
        if (slot < 0 || slot >= board.length) {
            return null;
        }

        Hero h = board[slot];
        board[slot] = null;
        return h;
    }

}
