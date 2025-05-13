import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-cadastrar-gift',
  templateUrl: './cadastrar-gift.page.html',
  styleUrls: ['./cadastrar-gift.page.scss'],
  imports: [IonicModule, FormsModule, CommonModule]
})
export class CadastrarGiftPage {

  gift = {
    nome: '',
    descricao: '',
    imagemUrl: '',
    precos: [0]
  };

  constructor(private router: Router) {
    this.verificarPermissao();
  }

  verificarPermissao() {
    // const user = localStorage.getItem('user'); // ou use AuthService
    // const isAdmin = user && JSON.parse(user).role === 'admin';
    // if (!isAdmin) {
    //   this.router.navigate(['/login']); // ou página de acesso negado
    // }
  }

  adicionarPreco() {
    this.gift.precos.push(0);
  }

  cadastrarGift() {
    // aqui tu faz aquele post com o axios , falta o adriano querer
    console.log('Gift cadastrado:', this.gift);
  }
}
