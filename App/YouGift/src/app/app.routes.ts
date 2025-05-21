import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: 'home',
    loadComponent: () => import('./home/home.page').then((m) => m.HomePage),
  },
  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full',
  },
  {
    path: 'login',
    loadComponent: () => import('./login/login.page').then( m => m.LoginPage)
  },
  {
    path: 'signup',
    loadComponent: () => import('./signup/signup.page').then( m => m.SignupPage)
  },
  {
    path: 'tela-compra',
    loadComponent: () => import('./tela-compra/tela-compra.page').then( m => m.TelaCompraPage)
  },
  {
    path: 'tela-compra/:nome',
    loadComponent: () => import('./tela-compra/tela-compra.page').then( m => m.TelaCompraPage)
  },
  {
    path: 'cadastrar-gift',
    loadComponent: () => import('./cadastrar-gift/cadastrar-gift.page').then( m => m.CadastrarGiftPage)
  },
  {
    path: 'tela-pagamento/:id',
    loadComponent: () => import('./tela-pagamento/tela-pagamento.page').then( m => m.TelaPagamentoPage)
  },
];
