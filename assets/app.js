/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../node_modules/bootstrap/scss/bootstrap-reboot.scss';
import '../node_modules/pikaday/css/pikaday.css';
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import Pikaday from 'pikaday';

Array.from(document.querySelectorAll('.js-datepicker')).forEach(datepicker => {
  new Pikaday({
    field: datepicker,
    format: 'YYYY-m-d',
    toString(date, format) {
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();
        return `${year}-${month}-${day}`;
        // TODO return i18n'ed date
        return new Date(year, month, day).toLocaleDateString(undefined, { year: 'numeric', month: '2-digit', day: '2-digit' });
    },
    parse(dateString, format) {
        const parts = dateString.split('/');
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const year = parseInt(parts[2], 10);
        return new Date(year, month, day);
    },
    i18n: {
      months        : ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'],
      weekdays      : ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
      weekdaysShort : ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam']
    }
  });
});