import { GetHost, CreateCss, SetIcon, SetHeader, SetNavBar, SetSocialMedia, SetFooter } from '../../../../Assets/Js/globals.functions.js';
import { SetAside } from '../../../Utils/asidebar.js';
CreateCss(`${GetHost()}/Front/Views/Assets/Css/styles.css`);
SetIcon(`${GetHost()}/Front/Views/Assets/Img/Spa_Logo.webp`);
//SetHeader('header');
//SetNavBar('nav');
const jsonButtons = [
    { text: 'Gráficos', href: '/Front/Views/Access/Admin/Graficos/', icon: 'bi-graph-up' },
    { text: 'Reportes', href: '/Front/Views/Access/Admin/Reportes/', icon: 'bi-file-spreadsheet-fill' },
    { text: 'Usuarios', href: '/Front/Views/Access/Admin/Usuarios/', icon: 'bi-person-circle' },
    { text: 'Clientes', href: '/Front/Views/Access/Admin/Clientes/', icon: 'bi-people-fill' },
    { text: 'Empleados', href: '/Front/Views/Access/Admin/Empleados/', icon: 'bi-person-vcard-fill' },
    { text: 'Servicios', href: '/Front/Views/Access/Admin/Servicios/', icon: 'bi-people-fill' },
    { text: 'Sesiones', href: '/Front/Views/Access/Admin/Sesiones/', icon: 'bi-people-fill' },
    { text: 'Productos', href: '/Front/Views/Access/Admin/Productos/', icon: 'bi-box-seam-fill' },
];
SetAside(jsonButtons);
SetFooter('footer');

export default jsonButtons
