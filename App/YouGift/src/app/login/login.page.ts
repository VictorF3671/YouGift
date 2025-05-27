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
  user: IUserLogin = {email:'',password:''}
  mostrarErro = false;
  mensagemErro = '';
  
  //cardType = '';
  constructor(private router: Router, private axiosContext: AxiosContextService) { }

  ngOnInit() {
      localStorage.removeItem('token');
      localStorage.getItem('token')
  }

  async verifyLogin(){
     console.log("entrei")
       if (!this.user.email || !this.user.password) {
        this.mensagemErro = "Preencha todos os campos corretamente";
        this.mostrarErro = true;
        return;

     }
    try{
      console.log(this.user)
      const response = await this.axios.post('/auth/login', this.user)
     
      if(response.data.token){
        const token = response.data.token
        localStorage.setItem('token', token)
        localStorage.setItem('group', 'admin' )
        // const group = response.data.group
        // localStorage.setItem('group', group.toString())
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
