
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `limbuscompanydb`.`view_identity_lengkap` 
    AS
(SELECT 
    i.identity_id,
    s.name AS sinner_name,
    f.faction_name,
    i.identity_name,
    i.rarity,
    i.damage_type
FROM identities i
JOIN sinners s ON i.sinner_id = s.sinner_id
LEFT JOIN factions f ON i.faction_id = f.faction_id);
