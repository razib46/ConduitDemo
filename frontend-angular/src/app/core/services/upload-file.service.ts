import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { ApiService } from './api.service';
import { Upload } from '../models/upload.model';

@Injectable()
export class UploadFileService {
    constructor(
        private apiService: ApiService
    ) { }

    uploadFile(url: string, file: File): Observable<Upload> {
        return this.apiService.upload(url, file)
            .pipe(map(data => data.file));
    }
}