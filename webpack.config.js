const HtmlWebpackPlugin = require ("html-webpack-plugin");

const path = require("path");

module.exports = {
    entry: {
        index: "./src/index.js",
        // usuarios: "./src/usuarios.js"
    },
    output: {
        filename: "App/vistas/js/[name].js",
        path: path.resolve(__dirname, "dist")
    },
    module: {
        rules: [{
            test: /\.css$/,
            use: ["style-loader", "css-loader"]
        }]
    },
    plugins: [
        /*new HtmlWebpackPlugin({
            template: "./src/index.php",
            filename: "./index.php"
        })*/
    ],
    mode: "development",
}