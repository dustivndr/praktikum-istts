import card.*;
import java.util.*;

public class Game {

    public static Scanner scanner = new Scanner(System.in);
    public static Random random = new Random();
    public static Troop[] troops = {
        new Troop("Goblins", 3, 1, 2),
        new Troop("Elixir Golem", 5, 2, 3),
        new Troop("Bomber", 4, 3, 4)
    };
    public static Building[] buildings = {
        new Building("Cannon", 5, 0, 4),
        new Building("Elixir Collector", 5, 0, 4),
        new Building("Goblin Hut", 5, 0, 5)
    };
    public static Spell[] spells = {
        new Spell("Fireball", 0, 0, 4),
        new Spell("Arrow", 0, 0, 3),
        new Spell("Goblin Barrel", 0, 0, 3)
    };

    private static Troop cloneTroop(Troop template) {
        return new Troop(template.getName(), template.getHp(), template.getDamage(), template.getElixirCost());
    }

    private static Building cloneBuilding(Building template) {
        return new Building(template.getName(), template.getHp(), template.getDamage(), template.getElixirCost());
    }

    private static void printActiveTroops(String owner, ArrayList<Troop> troopsInArena) {
        if (troopsInArena.isEmpty()) {
            return;
        }

        System.out.print("Active Troops " + owner + ": ");
        for (int i = 0; i < troopsInArena.size(); i++) {
            Troop troop = troopsInArena.get(i);
            System.out.print(troop.getName() + "(" + troop.getHp() + " HP)");
            if (i < troopsInArena.size() - 1) {
                System.out.print(", ");
            }
        }
        System.out.println();
    }

    private static void printActiveBuildings(String owner, ArrayList<Building> buildingsInArena) {
        if (buildingsInArena.isEmpty()) {
            return;
        }

        System.out.print("Active Buildings " + owner + ": ");
        for (int i = 0; i < buildingsInArena.size(); i++) {
            Building building = buildingsInArena.get(i);
            System.out.print(building.getName() + "(" + building.getHp() + " HP)");
            if (i < buildingsInArena.size() - 1) {
                System.out.print(", ");
            }
        }
        System.out.println();
    }

    private static int chooseRandomTowerTarget(int[] enemyPrincessTowers, int[] enemyKingTower) {
        ArrayList<Integer> alivePrincess = new ArrayList<>();
        for (int i = 0; i < enemyPrincessTowers.length; i++) {
            if (enemyPrincessTowers[i] > 0) {
                alivePrincess.add(i);
            }
        }

        if (!alivePrincess.isEmpty()) {
            return alivePrincess.get(random.nextInt(alivePrincess.size()));
        }

        if (enemyKingTower[0] > 0) {
            return 2;
        }

        return -1;
    }

    private static String deployTroopCard(Troop selectedCard, ArrayList<Troop> ownerTroops, String ownerName) {
        if (selectedCard.getName().equalsIgnoreCase("Goblins")) {
            int spawnCount = 2 + random.nextInt(4);
            for (int i = 0; i < spawnCount; i++) {
                ownerTroops.add(new Troop("Goblin", 3, 1, 0));
            }
            return ">> " + ownerName + " deploys Goblins(" + spawnCount + ")";
        }

        ownerTroops.add(cloneTroop(selectedCard));
        return ">> " + ownerName + " deploys " + selectedCard.getName();
    }

    private static void handleTroopDeathEffects(
            Troop deadTroop,
            String deadOwner,
            ArrayList<Troop> deadOwnerTroops,
            ArrayList<Building> deadOwnerBuildings,
            int[] deadOwnerPrincessTowers,
            int[] deadOwnerKingTower,
            ArrayList<Troop> opponentTroops,
            ArrayList<Building> opponentBuildings,
            int[] opponentPrincessTowers,
            int[] opponentKingTower,
            int[] playerElixirRef) {

        deadTroop.clearForcedTowerTarget();

        if (deadTroop.getName().equalsIgnoreCase("Elixir Golem")) {
            System.out.println("[EFFECT] " + deadOwner + " Elixir Golem split into 2 Mini Elixir Golems!");
            deadOwnerTroops.add(new Troop("Mini Elixir Golem", 2, 1, 0));
            deadOwnerTroops.add(new Troop("Mini Elixir Golem", 2, 1, 0));
            return;
        }

        if (deadTroop.getName().equalsIgnoreCase("Mini Elixir Golem") && deadOwner.equalsIgnoreCase("Player")) {
            playerElixirRef[0] = Math.min(10, playerElixirRef[0] + 1);
            System.out.println("[EFFECT] Mini Elixir Golem died => Player gains +1 Elixir");
            return;
        }

        if (deadTroop.getName().equalsIgnoreCase("Bomber")) {
            System.out.println("[EFFECT] Bomber exploded on everyone! (2 dmg)");

            int i = 0;
            while (i < opponentTroops.size()) {
                Troop troop = opponentTroops.get(i);
                troop.takeDamage(2);
                if (troop.isDead()) {
                    Troop deadTarget = opponentTroops.remove(i);
                    System.out.println("[DEATH] " + (deadOwner.equalsIgnoreCase("Player") ? "Enemy" : "Player") + " " + deadTarget.getName() + " died from explosion.");
                    handleTroopDeathEffects(
                            deadTarget,
                            deadOwner.equalsIgnoreCase("Player") ? "Enemy" : "Player",
                            opponentTroops,
                            opponentBuildings,
                            opponentPrincessTowers,
                            opponentKingTower,
                            deadOwnerTroops,
                            deadOwnerBuildings,
                            deadOwnerPrincessTowers,
                            deadOwnerKingTower,
                            playerElixirRef);
                } else {
                    i++;
                }
            }

            i = 0;
            while (i < opponentBuildings.size()) {
                Building building = opponentBuildings.get(i);
                building.takeDamage(2);
                if (building.isDead()) {
                    System.out.println("[DEATH] " + (deadOwner.equalsIgnoreCase("Player") ? "Enemy" : "Player") + " " + building.getName() + " destroyed by explosion.");
                    opponentBuildings.remove(i);
                } else {
                    i++;
                }
            }

            for (i = 0; i < opponentPrincessTowers.length; i++) {
                if (opponentPrincessTowers[i] > 0) {
                    damageTowerWithAnnouncement(deadOwner.equalsIgnoreCase("Player") ? "Enemy" : "Player", i, 2, opponentPrincessTowers, opponentKingTower);
                }
            }
            if (opponentKingTower[0] > 0) {
                damageTowerWithAnnouncement(deadOwner.equalsIgnoreCase("Player") ? "Enemy" : "Player", 2, 2, opponentPrincessTowers, opponentKingTower);
            }
        }
    }

    private static boolean performTroopAttack(
            Troop attacker,
            String attackerOwner,
            ArrayList<Troop> attackerTroops,
            ArrayList<Building> attackerBuildings,
            int[] attackerPrincessTowers,
            int[] attackerKingTower,
            ArrayList<Troop> defenderTroops,
            String defenderOwner,
            ArrayList<Building> defenderBuildings,
            int[] defenderPrincessTowers,
            int[] defenderKingTower,
            int[] playerElixirRef) {

        if (attacker.hasForcedTowerTarget()) {
            int lockedTowerTarget = attacker.getForcedTowerTarget();
            if (getTowerHp(lockedTowerTarget, defenderPrincessTowers, defenderKingTower) > 0) {
                System.out.println("[ATTACK] " + attackerOwner + " " + attacker.getName() + " => " + defenderOwner + " " + getTowerName(lockedTowerTarget) + " (" + attacker.getDamage() + " dmg)");
                damageTowerWithAnnouncement(defenderOwner, lockedTowerTarget, attacker.getDamage(), defenderPrincessTowers, defenderKingTower);

                if (getTowerHp(lockedTowerTarget, defenderPrincessTowers, defenderKingTower) > 0) {
                    int counterDamage = getTowerCounterDamage(lockedTowerTarget);
                    System.out.println("[COUNTER] " + defenderOwner + " " + getTowerName(lockedTowerTarget) + " => " + attackerOwner + " " + attacker.getName() + " (" + counterDamage + " dmg)");
                    attacker.takeDamage(counterDamage);
                    if (attacker.isDead()) {
                        System.out.println("[DEATH] " + attackerOwner + " " + attacker.getName() + " died from counter attack!");
                        handleTroopDeathEffects(
                                attacker,
                                attackerOwner,
                                attackerTroops,
                                attackerBuildings,
                                attackerPrincessTowers,
                                attackerKingTower,
                                defenderTroops,
                                defenderBuildings,
                                defenderPrincessTowers,
                                defenderKingTower,
                                playerElixirRef);
                        return false;
                    }
                }
                return true;
            }
            attacker.clearForcedTowerTarget();
        }

        if (!defenderTroops.isEmpty()) {
            int idx = random.nextInt(defenderTroops.size());
            Troop targetTroop = defenderTroops.get(idx);

            while (!attacker.isDead() && !targetTroop.isDead()) {
                System.out.println("[ATTACK] " + attackerOwner + " " + attacker.getName() + " => " + defenderOwner + " " + targetTroop.getName() + " (" + attacker.getDamage() + " dmg)");
                targetTroop.takeDamage(attacker.getDamage());

                if (targetTroop.isDead()) {
                    defenderTroops.remove(idx);
                    System.out.println("[DEATH] " + defenderOwner + " " + targetTroop.getName() + " died.");
                    handleTroopDeathEffects(
                            targetTroop,
                            defenderOwner,
                            defenderTroops,
                            defenderBuildings,
                            defenderPrincessTowers,
                            defenderKingTower,
                            attackerTroops,
                            attackerBuildings,
                            attackerPrincessTowers,
                            attackerKingTower,
                            playerElixirRef);
                    return true;
                }

                System.out.println("[COUNTER] " + defenderOwner + " " + targetTroop.getName() + " => " + attackerOwner + " " + attacker.getName() + " (" + targetTroop.getDamage() + " dmg)");
                attacker.takeDamage(targetTroop.getDamage());
                if (attacker.isDead()) {
                    System.out.println("[DEATH] " + attackerOwner + " " + attacker.getName() + " died from counter attack!");
                    handleTroopDeathEffects(
                            attacker,
                            attackerOwner,
                            attackerTroops,
                            attackerBuildings,
                            attackerPrincessTowers,
                            attackerKingTower,
                            defenderTroops,
                            defenderBuildings,
                            defenderPrincessTowers,
                            defenderKingTower,
                            playerElixirRef);
                    return false;
                }
            }
            return !attacker.isDead();
        }

        if (!defenderBuildings.isEmpty()) {
            int idx = random.nextInt(defenderBuildings.size());
            Building targetBuilding = defenderBuildings.get(idx);
            System.out.println("[ATTACK] " + attackerOwner + " " + attacker.getName() + " => " + defenderOwner + " " + targetBuilding.getName() + " (" + attacker.getDamage() + " dmg)");
            targetBuilding.takeDamage(attacker.getDamage());
            if (targetBuilding.isDead()) {
                defenderBuildings.remove(idx);
                System.out.println("[DEATH] " + defenderOwner + " " + targetBuilding.getName() + " destroyed.");
            }
            return true;
        }

        int targetTower = chooseRandomTowerTarget(defenderPrincessTowers, defenderKingTower);
        if (targetTower == -1) {
            return true;
        }

        System.out.println("[ATTACK] " + attackerOwner + " " + attacker.getName() + " => " + defenderOwner + " " + getTowerName(targetTower) + " (" + attacker.getDamage() + " dmg)");
        damageTowerWithAnnouncement(defenderOwner, targetTower, attacker.getDamage(), defenderPrincessTowers, defenderKingTower);

        if (getTowerHp(targetTower, defenderPrincessTowers, defenderKingTower) > 0) {
            int counterDamage = getTowerCounterDamage(targetTower);
            System.out.println("[COUNTER] " + defenderOwner + " " + getTowerName(targetTower) + " => " + attackerOwner + " " + attacker.getName() + " (" + counterDamage + " dmg)");
            attacker.takeDamage(counterDamage);
            if (attacker.isDead()) {
                System.out.println("[DEATH] " + attackerOwner + " " + attacker.getName() + " died from counter attack!");
                handleTroopDeathEffects(
                        attacker,
                        attackerOwner,
                        attackerTroops,
                        attackerBuildings,
                        attackerPrincessTowers,
                        attackerKingTower,
                        defenderTroops,
                        defenderBuildings,
                        defenderPrincessTowers,
                        defenderKingTower,
                        playerElixirRef);
                return false;
            }
        }

        return true;
    }

    private static void resolveTroopAttacks(
            ArrayList<Troop> attackerTroops,
            String attackerOwner,
            ArrayList<Building> attackerBuildings,
            int[] attackerPrincessTowers,
            int[] attackerKingTower,
            ArrayList<Troop> defenderTroops,
            String defenderOwner,
            ArrayList<Building> defenderBuildings,
            int[] defenderPrincessTowers,
            int[] defenderKingTower,
            int[] playerElixirRef) {

        int i = 0;
        while (i < attackerTroops.size()) {
            Troop attacker = attackerTroops.get(i);
            boolean alive = performTroopAttack(
                    attacker,
                    attackerOwner,
                    attackerTroops,
                    attackerBuildings,
                    attackerPrincessTowers,
                    attackerKingTower,
                    defenderTroops,
                    defenderOwner,
                    defenderBuildings,
                    defenderPrincessTowers,
                    defenderKingTower,
                    playerElixirRef);
            if (!alive) {
                attacker.clearForcedTowerTarget();
                attackerTroops.remove(i);
            } else {
                i++;
            }
        }
    }

    private static String getTowerName(int towerIndex) {
        if (towerIndex == 0) {
            return "Left Princess Tower";
        }
        if (towerIndex == 1) {
            return "Right Princess Tower";
        }
        return "King Tower";
    }

    private static int getTowerCounterDamage(int towerIndex) {
        if (towerIndex == 2) {
            return 5;
        }
        return 3;
    }

    private static int getTowerHp(int towerIndex, int[] enemyPrincessTowers, int[] enemyKingTower) {
        if (towerIndex == 0) {
            return enemyPrincessTowers[0];
        }
        if (towerIndex == 1) {
            return enemyPrincessTowers[1];
        }
        return enemyKingTower[0];
    }

    private static void damageSelectedTower(int towerIndex, int damage, int[] enemyPrincessTowers, int[] enemyKingTower) {
        if (towerIndex == 0) {
            enemyPrincessTowers[0] = Math.max(0, enemyPrincessTowers[0] - damage);
            return;
        }
        if (towerIndex == 1) {
            enemyPrincessTowers[1] = Math.max(0, enemyPrincessTowers[1] - damage);
            return;
        }
        enemyKingTower[0] = Math.max(0, enemyKingTower[0] - damage);
    }

    private static void damageTowerWithAnnouncement(String towerOwner, int towerIndex, int damage, int[] princessTowers, int[] kingTower) {
        int prevHp = getTowerHp(towerIndex, princessTowers, kingTower);
        if (prevHp <= 0) {
            return;
        }

        damageSelectedTower(towerIndex, damage, princessTowers, kingTower);
        if (getTowerHp(towerIndex, princessTowers, kingTower) <= 0) {
            System.out.println("[TOWER] " + towerOwner + " " + getTowerName(towerIndex) + " destroyed");
        }
    }

    private static int chooseAutoTowerTarget(int[] enemyPrincessTowers, int[] enemyKingTower) {
        return chooseRandomTowerTarget(enemyPrincessTowers, enemyKingTower);
    }

    private static int chooseEnemyTower(int[] enemyPrincessTowers, int[] enemyKingTower) {
        while (true) {
            System.out.println("Choose target tower:");
            System.out.println("1. Enemy Left Princess Tower");
            System.out.println("2. Enemy Right Princess Tower");
            System.out.println("3. Enemy King Tower");
            System.out.print(">> ");

            int pick = scanner.nextInt();
            if (pick < 1 || pick > 3) {
                System.out.println("Invalid choice.");
                continue;
            }

            int idx;
            switch (pick) {
                case 1 -> idx = 0;
                case 2 -> idx = 1;
                case 3 -> idx = 2;
                default -> idx = -1;
            }

            if (getTowerHp(idx, enemyPrincessTowers, enemyKingTower) <= 0) {
                System.out.println("Target tower already destroyed, choose another tower.");
                continue;
            }

            return idx;
        }
    }

    private static void applyBuildingTurnEffects(
            String owner,
            ArrayList<Building> ownerBuildings,
            ArrayList<Troop> ownerTroops,
            int[] targetPrincessTowers,
            int[] targetKingTower,
            int[] ownerElixirRef) {

        if (ownerBuildings.isEmpty()) {
            return;
        }

        for (Building building : ownerBuildings) {
            String buildingName = building.getName();
            String targetOwner = owner.equalsIgnoreCase("Player") ? "Enemy" : "Player";

            if (buildingName.equalsIgnoreCase("Cannon")) {
                int targetTower = chooseRandomTowerTarget(targetPrincessTowers, targetKingTower);
                if (targetTower != -1) {
                    damageTowerWithAnnouncement(targetOwner, targetTower, 2, targetPrincessTowers, targetKingTower);
                    System.out.println("[EFFECT] " + owner + " Cannon menyerang " + targetOwner + " " + getTowerName(targetTower) + " (2 dmg)");
                }
                continue;
            }

            if (buildingName.equalsIgnoreCase("Elixir Collector")) {
                if (ownerElixirRef != null) {
                    ownerElixirRef[0] = Math.min(10, ownerElixirRef[0] + 1);
                    System.out.println("[EFFECT] " + owner + " Elixir Collector masih aktif => " + owner + " mendapatkan +1 elixir");
                } else {
                    System.out.println("[EFFECT] " + owner + " Elixir Collector masih aktif.");
                }
                continue;
            }

            if (buildingName.equalsIgnoreCase("Goblin Hut")) {
                int spawnCount = 2 + random.nextInt(3);
                System.out.println("[EFFECT] " + owner + " Goblin Hut masih aktif => spawn " + spawnCount + " goblin untuk menyerang");
                for (int i = 0; i < spawnCount; i++) {
                    ownerTroops.add(new Troop("Goblin", 3, 1, 0));
                }
            }
        }
    }

    private static void applySpellLogic(
            Spell selectedSpell,
            String casterOwner,
            boolean manualTarget,
            int[] targetPrincessTowers,
            int[] targetKingTower,
            String targetOwner,
            ArrayList<Troop> casterTroops) {

        String spellName = selectedSpell.getName();

        if (spellName.equalsIgnoreCase("Fireball")) {
            int targetTower = manualTarget
                    ? chooseEnemyTower(targetPrincessTowers, targetKingTower)
                    : chooseAutoTowerTarget(targetPrincessTowers, targetKingTower);
            damageTowerWithAnnouncement(targetOwner, targetTower, 4, targetPrincessTowers, targetKingTower);
            System.out.println("[EFFECT] " + casterOwner + " " + spellName + " melakukan damage sebesar 4 pada " + targetOwner + " " + getTowerName(targetTower));
            return;
        }

        if (spellName.equalsIgnoreCase("Arrow")) {
            for (int i = 0; i < targetPrincessTowers.length; i++) {
                if (targetPrincessTowers[i] > 0) {
                    damageTowerWithAnnouncement(targetOwner, i, 2, targetPrincessTowers, targetKingTower);
                }
            }
            if (targetKingTower[0] > 0) {
                damageTowerWithAnnouncement(targetOwner, 2, 2, targetPrincessTowers, targetKingTower);
            }
            System.out.println("[EFFECT] " + casterOwner + " Arrow menyerang semua tower dengan damage sebesar 2");
            return;
        }

        if (spellName.equalsIgnoreCase("Goblin Barrel")) {
            int targetTower = manualTarget
                    ? chooseEnemyTower(targetPrincessTowers, targetKingTower)
                    : chooseAutoTowerTarget(targetPrincessTowers, targetKingTower);
            damageTowerWithAnnouncement(targetOwner, targetTower, 2, targetPrincessTowers, targetKingTower);
            System.out.println("[EFFECT] " + casterOwner + " Goblin Barrel melakukan damage sebesar 2 pada " + targetOwner + " " + getTowerName(targetTower));

            int spawnCount = 1 + random.nextInt(3);
            System.out.println("[EFFECT] " + casterOwner + " Goblin Barrel spawn " + spawnCount + " goblin");
            for (int i = 0; i < spawnCount; i++) {
                Troop goblin = new Troop("Goblin", 3, 1, 0);
                goblin.setForcedTowerTarget(targetTower);
                casterTroops.add(goblin);
            }
            return;
        }

        System.out.println("Spell has no special logic yet.");
    }

    private static String doEnemyTurn(ArrayList<Troop> enemyTroops, ArrayList<Building> enemyBuildings, Spell[] enemySpellRef) {
        int roll = random.nextInt(100);
        if (roll < 25) {
            return ">> Enemy skipped their turn.";
        }

        if (roll < 55) {
            Troop randomEnemyCard = troops[random.nextInt(troops.length)];
            return deployTroopCard(randomEnemyCard, enemyTroops, "Enemy");
        }

        if (roll < 80) {
            Building randomEnemyBuilding = buildings[random.nextInt(buildings.length)];
            enemyBuildings.add(cloneBuilding(randomEnemyBuilding));
            return ">> Enemy deploys " + randomEnemyBuilding.getName();
        }

        Spell randomEnemySpell = spells[random.nextInt(spells.length)];
        enemySpellRef[0] = randomEnemySpell;
        return ">> Enemy deploys " + randomEnemySpell.getName();
    }

    public static void game() {

        int elixir = 5, turn = 1;
        int[] enemyPrincessTowers = {10, 10}, playerPrincessTowers = {10, 10};
        int[] enemyKingTower = {20}, playerKingTower = {20};
        ArrayList<Troop> enemyTroops = new ArrayList<>();
        ArrayList<Troop> playerTroops = new ArrayList<>();
        ArrayList<Building> enemyBuildings = new ArrayList<>();
        ArrayList<Building> playerBuildings = new ArrayList<>();

        while (true) {

            int troopIndex = random.nextInt(troops.length);
            int buldingIndex = random.nextInt(buildings.length);
            int spellIndex = random.nextInt(spells.length);
            Troop randomTroop = troops[troopIndex];
            Building randomBuilding = buildings[buldingIndex];
            Spell randomSpell = spells[spellIndex];

            String playerActionLog = "";
            Spell spellToResolve = null;
            Spell[] enemySpellToResolve = {null};
            String validationMessage = "";
            boolean validActionChosen = false;

            while (!validActionChosen) {
                System.out.println();
                System.out.println("==========================");
                System.out.println("|      CLASH ROYALE      |");
                System.out.println("==========================");
                System.out.println("|        [Enemy]         |");
                if (!enemyBuildings.isEmpty() || !enemyTroops.isEmpty()) {
                    System.out.println("==========================");
                }
                printActiveBuildings("Enemy", enemyBuildings);
                printActiveTroops("Enemy", enemyTroops);
                System.out.println("| [PT]     [KT]     [PT] |");
                System.out.println("| [" + enemyPrincessTowers[0] + "]     [" + enemyKingTower[0] + "]     [" + enemyPrincessTowers[1] + "] |");
                System.out.println("|                        |");
                System.out.println("--------- RIVER --------- ");
                System.out.println("|                        |");
                System.out.println("| [" + playerPrincessTowers[0] + "]     [" + playerKingTower[0] + "]     [" + playerPrincessTowers[1] + "] |");
                System.out.println("| [PT]     [KT]     [PT] |");
                System.out.println("|        [Player]        |");
                if (!playerBuildings.isEmpty() || !playerTroops.isEmpty()) {
                    System.out.println("==========================");
                }
                printActiveBuildings("Player", playerBuildings);
                printActiveTroops("Player", playerTroops);
                System.out.println("==========================");

                if (!validationMessage.isEmpty()) {
                    System.out.println(validationMessage);
                }

                System.out.println("Elixir: " + elixir + "/10");
                System.out.println("Choose a card:");

                System.out.print("1. ");
                randomTroop.displayForSelect();
                System.out.println();

                System.out.print("2. ");
                randomBuilding.displayForSelect();
                System.out.println();

                System.out.print("3. ");
                randomSpell.displayForSelect();
                System.out.println();

                System.out.println("4. Skip Turn");
                System.out.print(">> ");
                int pil = scanner.nextInt();

                switch (pil) {
                    case 1 -> {
                        if (elixir < randomTroop.getElixirCost()) {
                            validationMessage = "Not enough elixir";
                        } else {
                            elixir -= randomTroop.getElixirCost();
                            playerActionLog = deployTroopCard(randomTroop, playerTroops, "Player");
                            validActionChosen = true;
                        }
                    }
                    case 2 -> {
                        if (elixir < randomBuilding.getElixirCost()) {
                            validationMessage = "Not enough elixir";
                        } else {
                            elixir -= randomBuilding.getElixirCost();
                            playerBuildings.add(cloneBuilding(randomBuilding));
                            playerActionLog = ">> Player deploys " + randomBuilding.getName();
                            validActionChosen = true;
                        }
                    }
                    case 3 -> {
                        if (elixir < randomSpell.getElixirCost()) {
                            validationMessage = "Not enough elixir";
                        } else {
                            elixir -= randomSpell.getElixirCost();
                            playerActionLog = ">> Player deploys " + randomSpell.getName();
                            spellToResolve = randomSpell;
                            validActionChosen = true;
                        }
                    }
                    case 4 -> {
                        playerActionLog = ">> Player skipped their turn.";
                        validActionChosen = true;
                    }
                    case 10 -> {
                        elixir = 10;
                        playerActionLog = ">> Debug: elixir set to 10.";
                        validActionChosen = true;
                    }
                    default -> {
                        validationMessage = "Input tidak valid";
                    }
                }
            }

            System.out.println();
            System.out.println("=========== TURN " + turn + " ===========");
            System.out.println(playerActionLog);

            String enemyActionLog = doEnemyTurn(enemyTroops, enemyBuildings, enemySpellToResolve);
            System.out.println(enemyActionLog);

            if (spellToResolve != null) {
                applySpellLogic(spellToResolve, "Player", true, enemyPrincessTowers, enemyKingTower, "Enemy", playerTroops);
            }

            if (enemySpellToResolve[0] != null) {
                applySpellLogic(enemySpellToResolve[0], "Enemy", false, playerPrincessTowers, playerKingTower, "Player", enemyTroops);
            }
            System.out.println("------------------------------");

            int[] elixirRef = {elixir};
            applyBuildingTurnEffects("Player", playerBuildings, playerTroops, enemyPrincessTowers, enemyKingTower, elixirRef);
            applyBuildingTurnEffects("Enemy", enemyBuildings, enemyTroops, playerPrincessTowers, playerKingTower, null);

            resolveTroopAttacks(playerTroops, "Player", playerBuildings, playerPrincessTowers, playerKingTower, enemyTroops, "Enemy", enemyBuildings, enemyPrincessTowers, enemyKingTower, elixirRef);
            resolveTroopAttacks(enemyTroops, "Enemy", enemyBuildings, enemyPrincessTowers, enemyKingTower, playerTroops, "Player", playerBuildings, playerPrincessTowers, playerKingTower, elixirRef);
            elixir = elixirRef[0];

            if (enemyKingTower[0] <= 0) {
                System.out.println("Enemy King Tower destroyed. Player wins!");
                return;
            }

            if (playerKingTower[0] <= 0) {
                System.out.println("Player King Tower destroyed. Enemy wins!");
                return;
            }

            turn++;
            if (elixir < 10) {
                elixir++;
            }
            if (elixir < 0) {
                elixir = 0;
            }
        }
    }
}
