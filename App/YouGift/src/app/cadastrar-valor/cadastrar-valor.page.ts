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
  constructor(private router: Router, private axiosContext: AxiosContextService) { }

  ngOnInit() {
  }

  async carregarCompanys(){

  }
  navegarHome() {
    this.router.navigate(['/home']);
  }

  fecharErro(){
    this.mostrarErro = false;
  }
}
