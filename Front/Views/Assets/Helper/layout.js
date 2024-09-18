import { GetHost, CreateCss, SetIcon, SetHeader, SetNavBar, SetSocialMedia, SetFooter, CreateScript } from '../Js/globals.functions.js';
CreateCss(`${GetHost()}/Front/Views/Assets/Css/styles.css`);
SetIcon(`${GetHost()}/Front/Views/Assets/Img/Spa_Logo.webp`);
SetHeader('header');
SetNavBar('nav');
SetSocialMedia('div.Social-Media');
SetFooter('footer');
CreateScript(`${GetHost()}/Front/Views/Assets/Js/bootstrap.bundle.min.js`);