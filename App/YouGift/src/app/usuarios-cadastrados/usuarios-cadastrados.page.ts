import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { AxiosContextService } from 'src/server/axiosContext.server';

export interface IUsuario {
  id: number;
  cpf: string;
  fullname: string;
  email: string;
  password: string;
  phone_number: string;
  group: number;
}

@Component({
  selector: 'app-usuarios-cadastrados',
  templateUrl: './usuarios-cadastrados.page.html',
  styleUrls: ['./usuarios-cadastrados.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule]
})
export class UsuariosCadastradosPage implements OnInit {
  users: IUsuario[] = [
    {
      id: 0,
      cpf: '',
      fullname: '',
      email: '',
      password: '',
      phone_number: '',
      group: 2
    }
  ]; 
  private axios = this.axiosContext.getAxiosInstance();
  constructor(private router: Router, private axiosContext: AxiosContextService) {}

  ngOnInit() {
    this.carregarUsuarios();
  }

  async carregarUsuarios() {
    const response =  await this.axios.get('/users')
    this.users = response.data     
  }
  

  excluirUsuario(id: number) {
    // if (confirm('Tem certeza que deseja excluir este gift?')) {
    //   this.http.delete(`http://sua-api.com/gifts/${id}`).subscribe(() => {
    //     this.carregarGifts(); // Recarrega a lista após exclusão
    //   });
    // }
  }
}