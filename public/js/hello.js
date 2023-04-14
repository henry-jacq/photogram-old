var primary =
  "font-weight: bold; -webkit-text-stroke: 0.3px black; padding-top: 0.5em; font-size: 2em; padding-bottom: 0.3em";
var secondary = "padding-top: 0.5em; font-size: 13px; padding-bottom: 0.5em";

var message =
  "Does photogram need any fixes or improvements? Open an issue or contribute a merge request. At Photogram, everyone can contribute!";

var contribute =
  "🤝 Contribute to Photogram: https://git.selfmade.ninja/Henry/photogram/ \n🔎 Create a new issue: https://git.selfmade.ninja/Henry/photogram/-/issues/new";

console.log(
  `%cWelcome to Photogram!\n%c${message}\n${contribute}`,
  primary,
  secondary
);
