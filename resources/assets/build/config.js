module.exports = {
  entry: {
    main: ['./resources/assets/sass/main.scss', './resources/assets/js/main.js'],
    // editor: ['./resources/assets/js/editor/editor.js'],
    // form: ['./resources/assets/js/components/form/form.js'],
    new: ['./resources/assets/js/new.js'],
    auth: ['./resources/assets/js/auth.js'],
  },
  port: 3003,
  html: false,
  browsers: ['last 2 versions', 'ie > 8'],
  assets_url: '/assets/',  // Urls dans le fichier final attention au / à la fin pour la génération du fichier assets.json !!
  assets_path: './public/assets/', // ou build ? : Attention -> obligation de mettre le / à  la fin
  stylelint: './css/**/*.scss',
  refresh: ['./resources/views/**/*.twig'], // Permet de forcer le rafraichissement du navigateur lors de la modification de ces fichiers
  historyApiFallback: false // Passer à true si on utilise le mode: 'history' de vue-router (redirige toutes les requêtes sans réponse vers index.html)
}
