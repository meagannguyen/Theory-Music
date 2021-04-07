import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;


public class SQLConnection {

	private static Connection connection;

	public static void main(String[] args) {

		openConnection();

		closeConnection();
	}

	private static void openConnection() {
		String user = "nguyenm26";
		String password = "V00873715";
		String database = "project_nguyenm26";

		String url = "jdbc:mysql://3.238.242.230:3306/" + database;

		try {
			connection = DriverManager.getConnection(url, user, password);
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

	private static void closeConnection() {
		try {
			connection.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}