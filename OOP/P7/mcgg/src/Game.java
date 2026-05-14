import java.util.ArrayList;
import java.util.Random;
import java.util.Scanner;

public class Game {

    public static Scanner sc = new Scanner(System.in);
    private static final Random rnd = new Random();

    private static final Hero[] POOL = new Hero[] {
        new Hero("Akai","Tank",120,15,5,"Melee","Nature", Skills.AKAI,1,3),
        new Hero("Tigreal","Tank",130,12,4,"Melee","Lightborn", Skills.TIGREAL,1,3),
        new Hero("Layla","Marksman",80,25,8,"Ranged","Tech", Skills.LAYLA,1,3),
        new Hero("Miya","Marksman",75,23,9,"Ranged","Nature", Skills.MIYA,1,3),
        new Hero("Eudora","Mage",70,30,6,"Ranged","Lightborn", Skills.EUDORA,1,4),
        new Hero("Saber","Assassin",85,27,9,"Melee","Tech", Skills.SABER,1,4),
        new Hero("Karina","Assassin",90,26,8,"Melee","Nature", Skills.KARINA,1,4),
        new Hero("Rafaela","Support",85,10,6,"Ranged","Lightborn", Skills.RAFAELA,1,3)
    };

    private static class Synergy {
        String name;
        String[] members;
        int required;
        String effect;
        Synergy(String name, String[] members, int required, String effect) {
            this.name = name;
            this.members = members;
            this.required = required;
            this.effect = effect;
        }
    }

    private static final Synergy[] SYNERGIES = new Synergy[] {
        new Synergy("Nature", new String[] {"Akai","Miya","Karina"}, 3, "Regenerate 5 HP each turn"),
        new Synergy("Lightborn", new String[] {"Tigreal","Eudora","Rafaela"}, 3, "All heroes HP +20"),
        new Synergy("Tech", new String[] {"Layla","Saber"}, 2, "All heroes Attack +10")
    };

    public static void loop(Player p1, Player p2) {
        int turn = 1;
        Player current = p1;
        Player other = p2;

        while (p1.getHp() > 0 && p2.getHp() > 0) {
            render(turn, current, other);
            System.out.print(">> ");
            String cmd = sc.nextLine().trim();

            switch (cmd) {
                case "s" -> shop(current);
                case "e" -> sell(current);
                case "p" -> place(current);
                case "l" -> levelUp(current);
                case "n" -> {
                    System.out.println("Starting battle...");
                    battle(current, other);
                    postBattleIncome(current);
                    postBattleIncome(other);
                    
                    Player temp = current;
                    current = other;
                    other = temp;
                    turn++;
                }
                case "q" -> {
                    System.out.println("Game ended.");
                    return;
                }
                default -> System.out.println("Invalid command.");
            }
        }

        if (p1.getHp() > 0)
            System.out.println("\n" + p1.getName() + " wins the game!");
        else
            System.out.println("\n" + p2.getName() + " wins the game!");

    }

    private static void render(int turn, Player current, Player other) {
        System.out.println();
        System.out.println("===================================");
        System.out.println("Turn " + turn + " | " + current.getName() + " (" + current.getHp() + ") vs " + other.getName() + " (" + other.getHp() + ")");
        System.out.println("===================================");
        System.out.println("Player: " + current.getName());
        System.out.println("Gold:" + current.getGold() + "\tInterest:+" + (current.getGold()/10) + "\tLv:" + current.getLevel());
        System.out.println("Board Limit: " + current.boardCount() + "/" + current.boardLimit());
        System.out.println("===================================");

        ArrayList<String> synergyLines = computeSynergyLines(current);
        if (synergyLines.isEmpty()) {
            System.out.println("Synergy: none");
        } else {
            System.out.println("Synergy: ");
            for (String line : synergyLines)
                System.out.println("- " + line);
        }
        System.out.println("===================================");
        renderBoardSection("Player 1", current.getBoard(), false);
        System.out.println("-----------------------------------");
        renderBoardSection("Player 2", other.getBoard(), true);
        System.out.println("===================================");
        System.out.println("Heroes (" + current.getInventory().size() + "/6)");
        renderInventoryGrid(current);
        System.out.println("===================================");
        System.out.println("[s]shop | [e]sell | [p]place | [n]next | [l] level up");
    }

    private static void renderBoardSection(String playerLabel, Hero[] board, boolean reverseRows) {
        System.out.println("            [" + playerLabel + "]");
        if (!reverseRows) {
            System.out.print("Back Row  : ");
            for (int i = 0; i < 4; i++)
                System.out.print(slotToString(board[i]));
            System.out.println();
            System.out.print("Front Row : ");
            for (int i = 4; i < 8; i++)
                System.out.print(slotToString(board[i]));
            System.out.println();
        } else {
            System.out.print("Front Row : ");
            for (int i = 4; i < 8; i++)
                System.out.print(slotToString(board[i]));
            System.out.println();
            System.out.print("Back Row  : ");
            for (int i = 0; i < 4; i++)
                System.out.print(slotToString(board[i]));
            System.out.println();
        }
    }

    private static void renderInventoryGrid(Player current) {
        ArrayList<Hero> inventory = (ArrayList<Hero>) current.getInventory();
        for (int i = 0; i < 6; i += 2) {
            String left = inventoryEntry(inventory, i);
            String right = inventoryEntry(inventory, i + 1);
            String line = left;
            int padding = 18 - left.length();
            for (int p = 0; p < padding; p++) {
                line += " ";
            }
            line += "  " + right;
            System.out.println(line);
        }
    }

    private static String inventoryEntry(ArrayList<Hero> inventory, int index) {
        if (index >= inventory.size()) {
            return "- [empty]";
        }
        Hero hero = inventory.get(index);

        return "- " + hero.getName() + " (" + hero.getStars() + "*)";
    }

    private static String slotToString(Hero h) {
        if (h == null) 
            return "[ - ]";

        return "[" + h.getName().charAt(0) + "*" + h.getStars() + "]";
    }

    private static void shop(Player p) {
        Hero[] shopSlots = new Hero[5];
        generateShopSlots(shopSlots);
        
        while (true) {
            displayShop(p, shopSlots);
            System.out.print(">> ");
            String input = sc.nextLine().trim();
            int choice = parseIntSafe(input, -1);
            
            if (choice == 0) {
                System.out.println("Exited shop.");
                break;
            } else if (choice >= 1 && choice <= 5) {
                int idx = choice - 1;
                if (shopSlots[idx] == null) {
                    System.out.println("Slot is empty.");
                } else {
                    Hero hero = shopSlots[idx];
                    if (p.getInventory().size() >= 6) {
                        System.out.println("Inventory full!");
                    } else if (p.spendGold(hero.getPrice())) {
                        p.addToInventory(hero.copy());
                        System.out.println(hero.getName() + " bought!");
                        shopSlots[idx] = null;
                    } else {
                        System.out.println("Not enough gold!");
                    }
                }
            } else if (choice == 6) {
                if (p.spendGold(2)) {
                    System.out.println("Rerolled!");
                    generateShopSlots(shopSlots);
                } else {
                    System.out.println("Not enough gold for reroll!");
                }
            } else {
                System.out.println("Invalid choice.");
            }
        }
    }
    
    private static void displayShop(Player p, Hero[] slots) {
        String border = "==========================";
        System.out.println(border);
        System.out.println(padLine("SHOP - Gold: " + p.getGold()));
        for (int i = 0; i < 5; i++) {
            if (slots[i] != null)
                System.out.println(padLine("[" + (i+1) + "] " + slots[i].getName() + " (3g)"));
            else
                System.out.println(padLine("[" + (i+1) + "] -"));
        }
        System.out.println(padLine("[6] Reroll (2g)"));
        System.out.println(padLine("[0] Exit"));
        System.out.println(border);
    }
    
    private static String padLine(String content) {
        int width = 22;
        if (content.length() >= width) {
            return "| " + content + " |";
        }
        int padding = width - content.length();

        return "| " + content + " ".repeat(padding) + " |";
    }
    
    private static void generateShopSlots(Hero[] slots) {
        for (int i = 0; i < 5; i++) {
            int idx = rnd.nextInt(POOL.length);
            slots[i] = POOL[idx].copy();
        }
    }

    private static void sell(Player p) {
        System.out.println("=== Sell Hero ===");
        
        ArrayList<HeroSource> allHeroes = new ArrayList<>();
        for (int i = 0; i < p.getInventory().size(); i++) {
            Hero h = p.getInventory().get(i);
            allHeroes.add(new HeroSource(h, true, i));
        }
        for (int i = 0; i < p.getBoard().length; i++) {
            Hero h = p.getBoard()[i];
            if (h != null) 
                allHeroes.add(new HeroSource(h, false, i));
        }
        
        if (allHeroes.isEmpty()) {
            System.out.println("No heroes to sell.");
            return;
        }
        
        for (int i = 0; i < allHeroes.size(); i++) {
            HeroSource hs = allHeroes.get(i);
            Hero h = hs.hero;
            int gold = h.getStars() * 3;
            System.out.println((i+1) + ". " + h.getName() + " (" + h.getStars() + "*) - " + gold + "g");
        }
        System.out.println("0. Cancel");
        System.out.print(">> ");
        String input = sc.nextLine().trim();
        int choice = parseIntSafe(input, 0);
        
        if (choice == 0) {
            System.out.println("Cancelled.");
            return;
        }
        
        if (choice < 1 || choice > allHeroes.size()) {
            System.out.println("Invalid choice.");
            return;
        }
        
        HeroSource hs = allHeroes.get(choice - 1);
        Hero hero = hs.hero;
        int goldGain = hero.getStars() * 3;
        
        if (hs.fromInventory)
            p.removeFromInventory(hs.index);
        else
            p.removeFromBoard(hs.index);
        
        p.addGold(goldGain);
        System.out.println(hero.getName() + " (" + hero.getStars() + "*) sold, obtained " + goldGain + " gold.");
    }
    
    private static class HeroSource {
        Hero hero;
        boolean fromInventory;
        int index;
        HeroSource(Hero hero, boolean fromInventory, int index) {
            this.hero = hero;
            this.fromInventory = fromInventory;
            this.index = index;
        }
    }

    private static void place(Player p) {
        System.out.println("=== Place Hero ===");
        
        if (p.getInventory().isEmpty()) {
            System.out.println("No heroes in inventory to place.");
            return;
        }
        
        if (p.boardCount() >= p.boardLimit()) {
            System.out.println("Board is full!");
            return;
        }
        
        for (int i = 0; i < p.getInventory().size(); i++) {
            Hero h = p.getInventory().get(i);
            System.out.println((i+1) + ". " + h.getName() + " (" + h.getStars() + "*)");
        }
        System.out.println("0. Cancel");
        System.out.print(">> ");
        String input = sc.nextLine().trim();
        int heroChoice = parseIntSafe(input, 0);
        
        if (heroChoice == 0) {
            System.out.println("Cancelled.");
            return;
        }
        
        if (heroChoice < 1 || heroChoice > p.getInventory().size()) {
            System.out.println("Invalid choice.");
            return;
        }
        
        Hero hero = p.getInventory().get(heroChoice - 1);
        
        System.out.print("Pilih Row (1-Front Row, 2-Back Row): ");
        String rowInput = sc.nextLine().trim();
        int rowChoice = parseIntSafe(rowInput, -1);
        
        if (rowChoice != 1 && rowChoice != 2) {
            System.out.println("Invalid row. Choose 1 (Front) or 2 (Back).");
            return;
        }
        
        System.out.print("Pilih Slot (0 - 3): ");
        String slotInput = sc.nextLine().trim();
        int slot = parseIntSafe(slotInput, -1);
        
        if (slot < 0 || slot > 3) {
            System.out.println("Invalid slot. Choose 0-3.");
            return;
        }
        
        int boardSlot = (rowChoice == 1) ? (4 + slot) : slot;
        
        if (p.getBoard()[boardSlot] != null) {
            System.out.println("Slot is already occupied!");
            return;
        }
        
        p.removeFromInventory(heroChoice - 1);
        p.placeToBoard(hero, boardSlot);
        
        String rowName = (rowChoice == 1) ? "Front Row" : "Back Row";
        System.out.println("Hero " + hero.getName() + " placed in " + rowName + ", Slot " + slot + "!");
    }

    private static void levelUp(Player p) {
        int cost = 5;
        System.out.println("Level up cost: " + cost + " gold. Current level: " + p.getLevel());
        System.out.print("Confirm level up? (y/n): ");
        String c = sc.nextLine().trim();
        if (c.equalsIgnoreCase("y")) {
            if (p.spendGold(cost)) {
                p.levelUp();
                System.out.println("Leveled up to " + p.getLevel());
            } else 
                System.out.println("Not enough gold.");
        }
    }

    private static void battle(Player p1, Player p2) {
        System.out.println("\n========== BATTLE ===========");
        
        ArrayList<BattleUnit> units = new ArrayList<>();
        for (int i = 0; i < p1.getBoard().length; i++) {
            Hero h = p1.getBoard()[i];
            if (h != null) 
                units.add(new BattleUnit(h, p1, i < 4));
        }
        for (int i = 0; i < p2.getBoard().length; i++) {
            Hero h = p2.getBoard()[i];
            if (h != null) 
                units.add(new BattleUnit(h, p2, i < 4));
        }
        
        if (units.isEmpty()) {
            System.out.println("No heroes to battle!");
            return;
        }
        
        units.sort((a, b) -> {
            if (a.hero.getSpeed() != b.hero.getSpeed()) {
                return Integer.compare(b.hero.getSpeed(), a.hero.getSpeed());
            }
            return rnd.nextBoolean() ? -1 : 1;
        });
        
        while (hasAliveUnits(units, p1) && hasAliveUnits(units, p2)) {
            for (BattleUnit attacker : units) {
                if (!attacker.isAlive) 
                    continue;
                if (!hasAliveUnits(units, attacker.owner)) 
                    break;
                if (!hasAliveUnits(units, attacker.owner == p1 ? p2 : p1)) 
                    break;
                
                Player enemy = attacker.owner == p1 ? p2 : p1;
                BattleUnit target = findTarget(units, enemy, false);
                if (target == null) 
                    target = findTarget(units, enemy, true);
                if (target == null) 
                    continue;
                
                int damage = attacker.hero.getAttack();
                target.currentHp -= damage;
                if (target.currentHp < 0) target.currentHp = 0;
                attacker.counter++;
                
                String pl = attacker.owner == p1 ? "[P1]" : "[P2]";
                String tl = target.owner == p1 ? "[P1]" : "[P2]";
                String row = target.isBackRow ? "(Back)" : "(Front)";
                System.out.println(pl + " " + attacker.hero.getName() + " (SPD " + attacker.hero.getSpeed() + ")");
                System.out.println("- Target : " + tl + " " + target.hero.getName() + " " + row);
                System.out.println("- Damage : " + damage);
                System.out.println("- HP : " + (target.currentHp + damage) + " > " + target.currentHp);
                System.out.println("- Counter: " + attacker.counter + "/" + attacker.hero.getSkill().getTrigger());
                
                Skill skill = attacker.hero.getSkill();
                if (skill != null && attacker.counter >= skill.getTrigger()) {
                    attacker.counter = 0;
                    executeSkill(attacker.hero.getName(), attacker, target, units, enemy, p1, p2);
                }
                
                if (target.currentHp <= 0) {
                    target.isAlive = false;
                    System.out.println("X " + tl + " " + target.hero.getName() + " defeated");
                }
            }
        }
        
        boolean p1Wins = hasAliveUnits(units, p1);
        boolean p2Wins = hasAliveUnits(units, p2);
        
        if (p1Wins && !p2Wins) {
            System.out.println("\n[P1] " + p1.getName() + " wins!");
            applyBattleRewards(p1, p2, true);
        } else if (p2Wins && !p1Wins) {
            System.out.println("\n[P2] " + p2.getName() + " wins!");
            applyBattleRewards(p2, p1, true);
        }
        
        System.out.println("==============================\n");
    }
    
    private static boolean hasAliveUnits(ArrayList<BattleUnit> units, Player p) {
        return units.stream().anyMatch(u -> u.isAlive && u.owner == p);
    }
    
    private static BattleUnit findTarget(ArrayList<BattleUnit> units, Player enemy, boolean backRowOnly) {
        for (BattleUnit u : units) {
            if (!u.isAlive || u.owner != enemy) continue;
            if (backRowOnly && !u.isBackRow) continue;
            if (!backRowOnly && u.isBackRow) continue;
            return u;
        }
        return null;
    }
    
    private static void executeSkill(String heroName, BattleUnit attacker, BattleUnit target, ArrayList<BattleUnit> units, Player enemy, Player p1, Player p2) {
        String tl = target.owner == p1 ? "[P1]" : "[P2]";
        
        switch (heroName) {
            case "Akai" -> {
                System.out.println("> STOMP!");
                for (BattleUnit u : units) {
                    if (u.isAlive && u.owner == enemy && !u.isBackRow) {
                        u.currentHp -= 5;
                        if (u.currentHp < 0) u.currentHp = 0;
                        System.out.println("- " + tl + " " + u.hero.getName() + " : 5dmg");
                        if (u.currentHp <= 0) u.isAlive = false;
                    }
                }
            }
            case "Layla" -> {
                System.out.println("> DOUBLE SHOT!");
                BattleUnit f = findTarget(units, enemy, false);
                if (f != null) {
                    f.currentHp -= 10;
                    if (f.currentHp < 0) f.currentHp = 0;
                    System.out.println("- Front: 10dmg");
                    if (f.currentHp <= 0) f.isAlive = false;
                }
                BattleUnit b = findTarget(units, enemy, true);
                if (b != null) {
                    b.currentHp -= 10;
                    if (b.currentHp < 0) b.currentHp = 0;
                    System.out.println("- Back: 10dmg");
                    if (b.currentHp <= 0) b.isAlive = false;
                }
            }
            case "Miya" -> {
                int bonus = attacker.hero.getAttack() * 2;
                System.out.println("> RAPID ATTACK! +" + bonus + "dmg");
                target.currentHp -= bonus;
                if (target.currentHp < 0) target.currentHp = 0;
                if (target.currentHp <= 0) target.isAlive = false;
            }
            case "Eudora" -> {
                System.out.println("> LIGHTNING BURST!");
                for (BattleUnit u : units) {
                    if (u.isAlive && u.owner == enemy) {
                        u.currentHp -= 5;
                        if (u.currentHp < 0) u.currentHp = 0;
                        System.out.println("- 5dmg");
                        if (u.currentHp <= 0) u.isAlive = false;
                    }
                }
            }
            case "Saber" -> {
                System.out.println("> BACKSTAB!");
                BattleUnit bk = findTarget(units, enemy, true);
                if (bk != null) {
                    bk.currentHp -= 5;
                    if (bk.currentHp < 0) bk.currentHp = 0;
                    System.out.println("- 5dmg");
                    if (bk.currentHp <= 0) bk.isAlive = false;
                }
            }
            case "Karina" -> {
                int shadow = attacker.hero.getAttack() * 2;
                System.out.println("> SHADOW KILL! +" + shadow + "dmg");
                target.currentHp -= shadow;
                if (target.currentHp < 0) target.currentHp = 0;
                if (target.currentHp <= 0) target.isAlive = false;
            }
            case "Rafaela" -> {
                System.out.println("> HEAL! +10hp");
                BattleUnit ally = units.stream().filter(u -> u.isAlive && u.owner == attacker.owner && u != attacker).findFirst().orElse(attacker);
                ally.currentHp += 10;
                if (ally.currentHp > ally.hero.getHp()) ally.currentHp = ally.hero.getHp();
            }
            case "Tigreal" -> System.out.println("> TAUNT!");
        }
    }
    
    private static void applyBattleRewards(Player winner, Player loser, boolean isWin) {
        int base = 5;
        int interest = Math.min(winner.getGold() / 10, 5);
        int bonus = isWin ? 2 : 1;
        int total = base + interest + bonus;
        winner.addGold(total);
        System.out.println(winner.getName() + " : +" + total + "g");
        
        loser.addGold(1);
        loser.adjustHp(-loser.getLevel());
        System.out.println(loser.getName() + " : -" + loser.getLevel() + "hp");
    }
    
    private static class BattleUnit {
        Hero hero;
        Player owner;
        int currentHp;
        int counter;
        boolean isAlive;
        boolean isBackRow;
        
        BattleUnit(Hero h, Player o, boolean back) {
            hero = h;
            owner = o;
            currentHp = h.getHp();
            counter = 0;
            isAlive = true;
            isBackRow = back;
        }
    }

    private static void postBattleIncome(Player p) {
        int interest = p.getGold() / 10;
        p.addGold(interest);
        System.out.println(p.getName() + " receives interest: +" + interest);
    }

    private static int parseIntSafe(String s, int def) {
        if (s == null) return def;
        s = s.trim();
        if (s.matches("-?\\d+")) return Integer.parseInt(s);
        return def;
    }

    private static ArrayList<String> computeSynergyLines(Player p) {
        ArrayList<String> out = new ArrayList<>();
        for (Synergy s : SYNERGIES) {
            int found = 0;
            for (String member : s.members) {
                for (Hero h : p.getBoard()) {
                    if (h != null && h.getName().equalsIgnoreCase(member)) {
                        found++;
                        break;
                    }
                }
            }
            boolean active = found >= s.required;
            if (found > 0 || active) {
                out.add(s.name + " " + found + "/" + s.required + (active ? "*" : "") + " - " + s.effect);
            }
        }
        return out;
    }

}
