const { DataTypes } = require("sequelize");
const { Op } = require("sequelize");
const { imagePaths } = require("../config/app.config");
module.exports = (sequelize, Sequelize) => {
  const Astrologer = sequelize.define(
    "applied_wallet_coupons",
    {
      id: {
        primaryKey: true,
        type: DataTypes.INTEGER,
        autoIncrement: true,
      },
      user_id: {
        type: DataTypes.INTEGER,
      },
      code: {
        type: DataTypes.STRING,
      },
      coupon_id: {
        type: DataTypes.INTEGER,
      },
      status: {
        type: DataTypes.INTEGER,
      }, 
      created_at: {
        type: DataTypes.DATE,
      },
    },
    {
      tableName: "applied_wallet_coupons",
      timestamps: false,
      defaultScope: {},
      scopes: {
        
      },
    }
  );

  return Astrologer;
};
