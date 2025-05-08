import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { IUserLogin } from './IUserLogin';
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, YCardErrorComponent ]
})
export class LoginPage implements OnInit {

  user: IUserLogin = {email:'',senha:''}
  mostrarErro = false;
  mensagemErro = '';
  //cardType = '';
  constructor() { }

  ngOnInit() {
  }
  async verifyLogin(){
    console.log("entrei")
       if (!this.user.email || !this.user.senha) {
        this.mensagemErro = "Preencha todos os campos corretamente";
        this.mostrarErro = true;
        //this.cardType = 'error';
        return;
    }
    

  }
  fecharErro(){
    this.mostrarErro = false;
  }
}
