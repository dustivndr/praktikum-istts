package card;

public class Card {

    String name;
    int hp, damage, elixirCost;

    public Card(String name, int hp, int damage, int elixirCost) {
        this.name = name;
        this.hp = hp;
        this.damage = damage;
        this.elixirCost = elixirCost;
    }

    public String getName() {
        return name;
    }

    public int getHp() {
        return hp;
    }

    public int getDamage() {
        return damage;
    }

    public int getElixirCost() {
        return elixirCost;
    }

    public void takeDamage(int amount) {
        if (amount <= 0) {
            return;
        }
        hp = Math.max(0, hp - amount);
    }

    public boolean isDead() {
        return hp <= 0;
    }

    public void displayForSelect() {
        System.out.print(name + " [COST: " + elixirCost + "]");
    }
    
}
