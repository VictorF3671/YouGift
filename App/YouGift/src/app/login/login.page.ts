import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';
import { IUserLogin } from './IUserLogin';
import { Router } from '@angular/router';
import { AxiosContextService } from 'src/server/axiosContext.server';
import axios from 'axios';


@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, YCardErrorComponent ]
})
export class LoginPage implements OnInit {
  private axios = this.axiosContext.getAxiosInstance();
  user: IUserLogin = {email:'',senha:''}
  mostrarErro = false;
  mensagemErro = '';
  
  //cardType = '';
  constructor(private router: Router, private axiosContext: AxiosContextService) { }

  ngOnInit() {
      localStorage.removeItem('token');
      localStorage.getItem('token')
  }

  async verifyLogin(){
       if (!this.user.email || !this.user.senha) {
        this.mensagemErro = "Preencha todos os campos corretamente";
        this.mostrarErro = true;
        return;

     }
    try{
      const response = await this.axios.post('/auth/login', this.user)
     
      if(response.data.token){
        const token = response.data.token
        const roles = response.data.roles
        localStorage.setItem('token', token)
        localStorage.setItem('role', roles)
        this.router.navigate(['/home'])
      }
    }catch (error: any) {
  if (error.response && error.response.status === 401) {
    this.mensagemErro = "Usuário ou senha incorretos";
  } else {
    this.mensagemErro = "Erro na conexão com o servidor";
  }
  this.mostrarErro = true;
}
  
    
  }
  
  navegar() {
    this.router.navigate(['/signup']);
  }
  fecharErro(){
    this.mostrarErro = false;
  }
}
