import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule ]
})
export class LoginPage implements OnInit {
  email: string = '';
  senha: string = '';

  constructor() { }

  ngOnInit() {
  }
  async verifyLogin(){
    console.log("entrei")
       if (!this.email || !this.senha) {
        alert("irmao, preenche tudo ai")
    }
  }
}
