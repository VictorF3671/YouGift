import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';
import { IUserLogin } from './IUserLogin';
import { Router } from '@angular/router';


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
  constructor(private router: Router) { }

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
    this.router.navigate(['/home'])

  }
  navegar() {
    this.router.navigate(['/signup']);
  }
  fecharErro(){
    this.mostrarErro = false;
  }
}
