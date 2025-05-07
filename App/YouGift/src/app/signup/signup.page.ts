import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { IUsuario } from './IUserSignUp';

import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, YCardErrorComponent]
})
export class SignupPage implements OnInit {
  user: IUsuario = { nome: '', email: '', senha: ''};
  mostrarErro = false;
  mensagemErro = '';
  constructor() { }

  ngOnInit() {
  }
  async verifySignUp(){
      console.log(this.user)
    if(!this.user.email || !this.user.nome || !this.user.senha){
        this.mensagemErro = " Preencha todos os campos corretamente";
        this.mostrarErro = true;
        return;
    }
    

  }
  fecharErro(){
    this.mostrarErro = false;
  }
}
