import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { IUsuario } from './IUserSignUp';
import { Router } from '@angular/router'
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';
import { AxiosContextService } from 'src/server/axiosContext.server';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, YCardErrorComponent]
})
export class SignupPage implements OnInit {
  private axios = this.axiosContext.getAxiosInstance();
  user: IUsuario = { nome: '', email: '', cpf: '', senha: '' };
  mostrarErro = false;
  mensagemErro = '';
  constructor(private router: Router, private axiosContext: AxiosContextService) { }

  ngOnInit() {
  }
  async verifySignUp() {
    if (!this.user.email || !this.user.nome || !this.user.senha || !this.user.cpf) {
      this.mensagemErro = " Preencha todos os campos corretamente";
      this.mostrarErro = true;
      return;
    }
    try {
      const response = this.axios.post('/Cadastro/', this.user)
      if (response.data.success) {
        this.router.navigate(['/login'])

      }
    } catch (error: any) {
      if (error.response && error.response.status === 401) {
        this.mensagemErro = "Usuário ou senha incorretos";
      } else {
        this.mensagemErro = "Erro na conexão com o servidor";
      }
      this.mostrarErro = true;
    }

  }
  navegar() {
    this.router.navigate(['/login'])
  }
  fecharErro() {
    this.mostrarErro = false;
  }
}
