CREATE  TABLE #__projects (
  id_project INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT ,
  tx_path TEXT ,
  vcs_path TEXT ,
  languages TEXT
);

CREATE TABLE #__resources (
  id_resource INTEGER PRIMARY KEY AUTOINCREMENT ,
  id_project INTEGER ,
  filename TEXT ,
  tx_rel_path TEXT ,
  vcs_rel_path TEXT
);
