const { DataTypes } = require("sequelize");

module.exports = (sequelize, Sequelize) => {
    const Blog = sequelize.define("blog", {
      id: {
        primaryKey: true,
        type: Sequelize.INTEGER,
        autoIncrement: true,
      },
      title:{
          type:Sequelize.STRING
      },
      desc:{
        type:Sequelize.STRING
      },
      position:{
        type:Sequelize.STRING
      },
      image:{
        type:Sequelize.STRING
      },
      author_name:{
        type:Sequelize.STRING
      },
      show_date:{
        type:Sequelize.DATE
      },
      blog_type: {
        type: Sequelize.INTEGER.UNSIGNED
      },
      video_url: {
        type: Sequelize.STRING,
      },
      status: {
        type: Sequelize.INTEGER.UNSIGNED
      },
      added_on: {
        type: DataTypes.DATE
      },
    },{
        timestamps: false,
        tableName: 'blog',
        scopes:{
          active:{
            where:{status:1}
          },
        }
    });

    return Blog;
};