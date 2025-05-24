import { Routes } from '@angular/router';
import { AuthGuard } from './guards/auth.guard';

export const routes: Routes = [
  {
    path: 'home',
    loadComponent: () => import('./home/home.page').then((m) => m.HomePage),
    canActivate: [AuthGuard] 
  },
  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full',
  },
  {
    path: 'login',
    loadComponent: () => import('./login/login.page').then( m => m.LoginPage), 
  },
  {
    path: 'signup',
    loadComponent: () => import('./signup/signup.page').then( m => m.SignupPage)
  },
  {
    path: 'tela-compra',
    loadComponent: () => import('./tela-compra/tela-compra.page').then( m => m.TelaCompraPage),
    canActivate: [AuthGuard] 
  },
  {
    path: 'tela-compra/:id',
    loadComponent: () => import('./tela-compra/tela-compra.page').then( m => m.TelaCompraPage),
    canActivate: [AuthGuard] 
  },
  {
    path: 'cadastrar-gift',
    loadComponent: () => import('./cadastrar-gift/cadastrar-gift.page').then( m => m.CadastrarGiftPage),
    canActivate: [AuthGuard] 
  },
  {
    path: 'tela-pagamento',
    loadComponent: () => import('./tela-pagamento/tela-pagamento.page').then( m => m.TelaPagamentoPage),
    canActivate: [AuthGuard] 
  },
  {
    path: 'gifts-cadastrados',
    loadComponent: () => import('./gifts-cadastrados/gifts-cadastrados.page').then( m => m.GiftsCadastradosPage)
  },  {
    path: 'cadastrar-valor',
    loadComponent: () => import('./cadastrar-valor/cadastrar-valor.page').then( m => m.CadastrarValorPage)
  },

];
