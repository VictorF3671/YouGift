import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { IUsuario } from './IUserSignUp';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SignupPage implements OnInit {
  user: IUsuario = { nome: '', email: '', senha: ''};

  constructor() { }

  ngOnInit() {
  }
  async verifySignUp(){
      console.log(this.user)
    if(!this.user.email || !this.user.nome || !this.user.senha){
      
      alert("preenche tudo ai bobao")
    }
  }
}
