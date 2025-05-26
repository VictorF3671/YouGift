import { Component } from '@angular/core';
import { IonApp, IonRouterOutlet } from '@ionic/angular/standalone';
import { addIcons } from 'ionicons';
import { home, settings, person, idCard, addOutline, personCircleOutline, trashOutline } from 'ionicons/icons';

addIcons({ home, settings , person, addOutline, idCard, personCircleOutline, trashOutline });
@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  imports: [IonApp, IonRouterOutlet],
})
export class AppComponent {
  constructor() {}
}
