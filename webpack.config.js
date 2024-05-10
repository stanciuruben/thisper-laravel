const path = require("path");

module.exports = {
    entry: {
        navbar: "./resources/ts/navbar.ts",
    },
    output: {
        filename: "[name].js",
        path: path.resolve(__dirname, "public/js/compiled"),
    },
    module: {
        rules: [
            {
                test: /\.ts$/,
                use: "ts-loader",
                include: [path.resolve(__dirname, "resources/ts")],
            },
        ],
    },
    resolve: {
        extensions: [".ts", ".js"],
    },
    mode: "production",
    target: ["web", "es5"],
};
