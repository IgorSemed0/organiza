import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Create({ cartaos, users }) {
    const { data, setData, post, processing, errors } = useForm({
        it_id_cartao: '',
        it_id_user_autor: '',
        vc_texto: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.comentarios.store'));
    };

    return (
        <AdminLayout title="Criar Comentário">
            <Head title="Criar Comentário" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Criar Comentário</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.comentarios.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_cartao">Cartão</Label>
                            <Select
                                value={data.it_id_cartao}
                                onValueChange={(value) => setData('it_id_cartao', value)}
                            >
                                <SelectTrigger id="it_id_cartao" className={errors.it_id_cartao ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um cartão" />
                                </SelectTrigger>
                                <SelectContent>
                                    {cartaos.map((cartao) => (
                                        <SelectItem key={cartao.id} value={cartao.id.toString()}>
                                            {cartao.vc_titulo}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_cartao && <p className="text-sm text-red-500">{errors.it_id_cartao}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user_autor">Autor</Label>
                            <Select
                                value={data.it_id_user_autor}
                                onValueChange={(value) => setData('it_id_user_autor', value)}
                            >
                                <SelectTrigger id="it_id_user_autor" className={errors.it_id_user_autor ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador" />
                                </SelectTrigger>
                                <SelectContent>
                                    {users.map((user) => (
                                        <SelectItem key={user.id} value={user.id.toString()}>
                                            {user.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_user_autor && <p className="text-sm text-red-500">{errors.it_id_user_autor}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_texto">Texto</Label>
                            <Input
                                id="vc_texto"
                                type="text"
                                value={data.vc_texto}
                                onChange={(e) => setData('vc_texto', e.target.value)}
                                className={errors.vc_texto ? 'border-red-500' : ''}
                            />
                            {errors.vc_texto && <p className="text-sm text-red-500">{errors.vc_texto}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Criar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}