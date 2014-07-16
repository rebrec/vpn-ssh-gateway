var conn = new Mongo();
db = conn.getDB("bdTest");
db.tickets.drop();
