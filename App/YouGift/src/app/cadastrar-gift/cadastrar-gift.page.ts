import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { IGiftCard } from './IGiftCard';
import { AxiosContextService } from 'src/server/axiosContext.server';
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';

@Component({
  selector: 'app-cadastrar-gift',
  templateUrl: './cadastrar-gift.page.html',
  styleUrls: ['./cadastrar-gift.page.scss'],
  imports: [IonicModule, FormsModule, CommonModule, YCardErrorComponent]
})
export class CadastrarGiftPage {
  private axios = this.axiosContext.getAxiosInstance();
  gift: IGiftCard = {
    nome: '',
    descricao: '',
    imagemURL: '',
    preco: 0
  };
  mostrarErro = false;
  mensagemErro = '';

  constructor(private router: Router, private axiosContext: AxiosContextService) {
    this.verificarPermissao();
  }

  
    verifyCadastro(){
         if(!this.gift.nome || !this.gift.descricao || !this.gift.imagemURL || !this.gift.preco){
          
          const response = this.axios.post('/giftcard', this.gift)

      }else{
        this.mensagemErro = "Preencha todos os campos corretamente"
        this.mostrarErro = true
    }
    }
      verificarPermissao() {
    
    // const user = localStorage.getItem('user'); // ou use AuthService
    // const isAdmin = user && JSON.parse(user).role === 'admin';
    // if (!isAdmin) {
    //   this.router.navigate(['/login']); // ou página de acesso negado
    // }

  }
  navegarHome() {
    // Aqui você pode redirecionar para a home ou outra página
    this.router.navigate(['/gifts-cadastrados']);
  }

  cadastrarGift() {
    // aqui tu faz aquele post com o axios , falta o adriano querer
    console.log('Gift cadastrado:', this.gift);
  }
    fecharErro(){
    this.mostrarErro = false;
  }
}
