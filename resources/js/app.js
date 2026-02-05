import './bootstrap';

/****
 * Duplicidade de instâncias de Alpine pode gerar conflitos. 
 * Veja se o consle do navegador acusa essa situação ao carregar a página.
 * Se uma instância de Alpine já está sendo importado em outro lugar, comente as linhas abaixo. * 
 */
 

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();

// resources/js/app.js
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';


/**
 * Seus plugins do Alpine aqui (ex: Alpine.plugin(focus)), se precisar.
 * Só evitte duplicidade de instâncias com Alpine.start() acima.
 * Pois o Livewire também importa o Alpine.
 */


Livewire.start();
