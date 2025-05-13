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
  private axios = this.axiosContext.getAxios();
  user: IUserLogin = {email:'',senha:''}
  mostrarErro = false;
  mensagemErro = '';
  
  //cardType = '';
  constructor(private router: Router, private axiosContext: AxiosContextService) { }

  ngOnInit() {
      
  }

  async verifyLogin(){
    console.log("entrei")
       if (!this.user.email || !this.user.senha) {
        this.mensagemErro = "Preencha todos os campos corretamente";
        this.mostrarErro = true;
        return;

    }
    try{
      const response = await axios.post('/login', this.user)

      const token = response.data.token

      localStorage.setItem('token', token)

      if(response.data.success){
        this.router.navigate(['/home'])
      }
    }catch(error){
      this.mensagemErro = "Erro na conexão com o servidor";
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
