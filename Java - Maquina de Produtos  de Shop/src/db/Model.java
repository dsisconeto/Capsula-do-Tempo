package db;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

public abstract class Model {

    private String table;
    private String primaryKey = "id";
    private int id;
    private ArrayList<Row> rows = new ArrayList<>();

    public void limparRows() {
        this.rows = new ArrayList<>();

    }

    protected boolean atualizar() {

        String sql = "UPDATE " + this.getTable() + " SET  ";
        String agumentos = "";
        String where = " WHERE " + this.getPrimaryKey() + " = ?";

        int d = this.rows.size();
        int i = 0;

        for (Row row : this.rows) {
            i++;
            agumentos += row.getNameRow() + "= ?";
            if (i != d) {
                agumentos += ",";
            }
        }

        sql += agumentos + where;

        try {
            Conexao.setPrepare(sql);
            System.out.println(sql);
            i = 0;
            for (Row row : this.rows) {
                i++;
                switch (row.getTipo()) {
                    case 1:
                        Conexao.prepare().setString(i, row.getLiteral());
                        break;
                    case 2:
                        Conexao.prepare().setInt(i, row.getInteiro());
                        break;
                    case 3:
                        Conexao.prepare().setDouble(i, row.getReal());
                        break;
                }
            }
            i++;

            Conexao.prepare().setInt(i, this.getId());
            Conexao.prepare().execute();
            return true;
        } catch (SQLException e) {

            System.out.print(e.getMessage());

            return false;
        }finally {

            this.limparRows();
        }

    }

    protected boolean registrar() {

        String sql = "INSERT INTO  " + this.getTable();
        String agumentos = "  (";
        String values = " VALUES(";
        int d = this.rows.size();
        int i = 0;
        for (Row row : this.rows) {
            i++;
            agumentos += row.getNameRow();
            values += " ?";
            if (i != d) {
                values += ",";
                agumentos += ",";
            }
        }

        agumentos += ")";
        values += ")";
        sql += agumentos + values;
        System.out.println(sql);
        try {
            Conexao.setPrepare(sql);

            i = 0;
            for (Row row : this.rows) {
                i++;
                switch (row.getTipo()) {
                    case 1:
                        Conexao.prepare().setString(i, row.getLiteral());
                        break;
                    case 2:
                        Conexao.prepare().setInt(i, row.getInteiro());
                        break;
                    case 3:
                        Conexao.prepare().setDouble(i, row.getReal());
                        break;

                    case 4:
                        Conexao.prepare().setDate(i, row.getData());
                        break;
                }
            }

            Conexao.prepare().execute();
            return true;
        } catch (SQLException e) {

            System.out.print(e.getMessage());

            return false;
        }finally {

            this.limparRows();
        }

    }

    protected ResultSet procurarUm() {
        String sql = "SELECT * FROM " + this.getTable();
        String where = " WHERE " + this.getPrimaryKey() + " = ?";
        sql += where;
        try {
            Conexao.setPrepare(sql);
            Conexao.prepare().setInt(1, this.getId());
            return Conexao.prepare().executeQuery();
        } catch (SQLException e) {
            System.out.print(e.getMessage());
            return null;
        }
        finally {

            this.limparRows();
        }
    }

    public ResultSet procurarTodos() {

        String sql = "SELECT * FROM " + this.getTable();
        System.out.println(sql);
        try {
            Conexao.setPrepare(sql);

            return Conexao.prepare().executeQuery();

        } catch (SQLException e) {
            System.out.print(e.getMessage());
            return null;
        } finally {

            this.limparRows();
        }
    }

    protected ResultSet procurarPor() {

        String sql = "SELECT * FROM " + this.getTable();
        String where = " WHERE ";

        int d = this.rows.size();
        int i = 0;

        for (Row row : this.rows) {
            i++;
            where += row.getNameRow() + " " + row.getOperador() + " ?";
            if (i != d && d > 1) {
                where += row.getCodicao();
            }
        }

        sql += where;
        System.out.println(sql);
        try {
            Conexao.setPrepare(sql);

            i = 0;
            for (Row row : this.rows) {
                i++;
                switch (row.getTipo()) {
                    case 1:
                        Conexao.prepare().setString(i, row.getLiteral());
                        break;
                    case 2:
                        Conexao.prepare().setInt(i, row.getInteiro());
                        break;
                    case 3:
                        Conexao.prepare().setDouble(i, row.getReal());
                        break;
                    case 4:
                        Conexao.prepare().setDate(i, row.getData());
                        break;
                }
            }

            return Conexao.prepare().executeQuery();

        } catch (SQLException e) {

            System.out.print(e.getMessage());
            return null;
        } finally {

            this.limparRows();
        }

    }

    protected boolean delete() {
        String sql = "DELETE FROM " + this.getTable();
        String where = " WHERE " + this.getPrimaryKey() + " = ?";
        sql += where;
        System.out.println(sql);
        try {
            Conexao.setPrepare(sql);
            Conexao.prepare().setInt(1, this.getId());

            Conexao.prepare().execute();
            return true;
        } catch (SQLException e) {
            System.out.print(e.getMessage());
            return false;
        } finally {

            this.limparRows();
        }
    }

    public void setRows(Row col) {

        this.rows.add(col);
    }

    public String getTable() {
        return table;
    }

    public void setTable(String table) {
        this.table = table;
    }

    public String getPrimaryKey() {
        return primaryKey;
    }

    public void setPrimaryKey(String primaryKey) {
        this.primaryKey = primaryKey;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
}
