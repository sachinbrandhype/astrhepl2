module.exports = {
    HOST: "localhost",
    USER: "root",
    PASSWORD: "",
    DB: "astrohelp",
    dialect: "mysql",
    pool: {
      max: 150,
      min: 0,
      acquire: 30000,
      idle: 10000
    }
};
