import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { AxiosContextService } from 'src/server/axiosContext.server';
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';

@Component({
  selector: 'app-cadastrar-valor',
  templateUrl: './cadastrar-valor.page.html',
  styleUrls: ['./cadastrar-valor.page.scss'],
  standalone: true,
  imports: [IonicModule, FormsModule, CommonModule, YCardErrorComponent]
})
export class CadastrarValorPage implements OnInit {
  private axios = this.axiosContext.getAxiosInstance();
  mostrarErro = false;
  mensagemErro = '';

  companies: any[] = [];
  empresaSelecionada: string = '';
  precos: number[] = [0]; // inicia com 1 input de preço

  constructor(private router: Router, private axiosContext: AxiosContextService) {}

  ngOnInit() {
    this.carregarEmpresas();
  }

  async carregarEmpresas() {
    try {
      const response = await this.axios.get('/giftcards');
      this.companies = response.data;
    } catch (error) {
      console.error('Erro ao carregar empresas', error);
    }
  }

  adicionarPreco() {
    this.precos.push(0);
  }

  async cadastrarValores() {
    try {
      for (const preco of this.precos) {
        await this.axios.post('/giftcard-values/', {
          gift_card: this.empresaSelecionada,
          value: preco
        });
      }
      console.log('Valores cadastrados com sucesso!');
      this.router.navigate(['/home']);
    } catch (error) {
      console.error('Erro ao cadastrar valores:', error);
      this.mostrarErro = true;
      this.mensagemErro = 'Erro ao cadastrar os valores. Verifique os dados e tente novamente.';
    }
  }

  navegarHome() {
    this.router.navigate(['/home']);
  }

  fecharErro() {
    this.mostrarErro = false;
  }
}