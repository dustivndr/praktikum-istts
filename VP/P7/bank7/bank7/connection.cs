using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Text;

namespace bank7
{
    public static class connection
    {
        static MySqlConnection dbConn;

        public static MySqlConnection getConn()
        {
            dbConn = new MySqlConnection(
                "Server=localhost;" +
                "Port=3306;" +
                "Database=pv_tugas_m7;" +
                "Uid=root;" +
                "Pwd=;"
                );
            return dbConn;
        }
    }
}
